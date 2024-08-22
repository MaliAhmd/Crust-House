<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\handler;
use App\Models\Product;
use Illuminate\Http\Request;

class OnlineOrdersController extends Controller
{

    public function viewOnlinePage()
    {
        $branches = Branch::whereIn('company_name', ['CrustHouse', 'crusthouse, Crust-House', 'crust-house'])->get();
        $branch_ids = [];
        foreach ($branches as $branch) {
            $branch_ids[] = $branch->id;
        }

        $branch_ids[] = [implode(',', $branch_ids)];

        $products = Product::whereIn('branch_id', $branch_ids)->get();

        $categories = Category::whereIn('branch_id', $branch_ids)->get();

        $deals = handler::where(function ($query) use ($branch_ids) {
            $query->whereHas('product', function ($query) use ($branch_ids) {
                $query->where('branch_id', $branch_ids);
            })->orWhereHas('deal', function ($query) use ($branch_ids) {
                $query->where('branch_id', $branch_ids);
            });
        })->with(['product' => function ($query) use ($branch_ids) {
                        $query->where('branch_id', $branch_ids);
                    }
                ])
            ->with('deal')
            ->get();

            $filteredCategories = $categories->filter(function ($category) use ($products) {
                return $products->contains('category_id', $category->id) && $category->categoryName !== 'Addons';
            });
    
        $filteredProducts = $products->reject(function ($product) {
            return $product->category_name === 'Addons';
        });

        return view('OnlineOrdering.layer')->with([
            'Products' => $filteredProducts,
            'Deals' => $deals,
            'Categories' => $filteredCategories,
            'AllProducts' => $products,
        ]);
    }
    // public function viewOnlineProducts($locationData)
    // {
    //     $locationDataArray = explode(',', urldecode($locationData));
    //     $branches = Branch::whereIn('company_name', ['CrustHouse', 'crusthouse, Crust-House', 'crust-house'])->get();
    //     $branch_ids = [];
    //     foreach ($branches as $branch) {
    //         $branch_ids[] = $branch->id;
    //     }

    //     $branch_ids[] = [implode(',', $branch_ids)];

    //     $products = Product::whereIn('branch_id', $branch_ids)->get();

    //     $categories = Category::whereIn('branch_id', $branch_ids)->get();

    //     $deals = handler::where(function ($query) use ($branch_ids) {
    //         $query->whereHas('product', function ($query) use ($branch_ids) {
    //             $query->where('branch_id', $branch_ids);
    //         })->orWhereHas('deal', function ($query) use ($branch_ids) {
    //             $query->where('branch_id', $branch_ids);
    //         });
    //     })->with(['product' => function ($query) use ($branch_ids) {
    //                     $query->where('branch_id', $branch_ids);
    //                 }
    //             ])
    //         ->with('deal')
    //         ->get();

    //     $filteredCategories = $categories->reject(function ($category) {
    //         return $category->categoryName === 'Addons';
    //     });

    //     $filteredProducts = $products->reject(function ($product) {
    //         return $product->category_name === 'Addons';
    //     });

    //     dd($filteredProducts, $deals, $filteredCategories , $products);
    //     return redirect()->back()->with([
    //         'Products' => $filteredProducts,
    //         'Deals' => $deals,
    //         'Categories' => $filteredCategories,
    //         'AllProducts' => $products,
    //     ]);

    // }
}
