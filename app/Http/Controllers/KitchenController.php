<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function viewChefDashboard($user_id, $branch_id)
    {
        if (!session()->has('chef')) {
            return redirect()->route('viewLoginPage');
        }
    
        $newOrders = Order::with('items')->where('status', 2)->where('branch_id',$branch_id)->get();
        $completeOrders = Order::with('items')->where('status', 1)->where('branch_id',$branch_id)->get();
    
        return view('Kitchen.Dashboard', [
            'newOrders' => $newOrders,
            'completeOrders' => $completeOrders
        ]);
    }
    

    public function orderComplete($order_id)
    {
        if (!session()->has('chef')) {
            return redirect()->route('viewLoginPage');
        }

        $order = Order::find($order_id);
        $order->status = 1;
        $order->save();
        return redirect()->back();
    }
    public function printChefRecipt($order_id)
    {
        if (!session()->has('chef')) {
            return redirect()->route('viewLoginPage');
        }
        
        $order = Order::with('salesman')->where('id', $order_id)->first();
        $products = OrderItem::where('order_id', $order_id)->get();
        $html = view('KitchenRecipt', ['products' => $products, 'orderData' => $order])->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $height = $dompdf->getCanvas()->get_height();
        $dompdf->setPaper([0, 0, 300, $height / 2.5], 'portrait');
        $dompdf->render();
        $dompdf->stream($order->order_number . '.pdf');
    }
}
