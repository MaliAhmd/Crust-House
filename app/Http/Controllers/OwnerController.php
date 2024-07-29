<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Order;
use App\Models\OwnerSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{

    public function viewOwnerDashboard($owner_id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }

        $branches = Branch::all();
        $settings = OwnerSetting::where('owner_id', $owner_id)->first();
        session()->put('OwnerSettings', $settings);

        $totalBranches = $this->totalBranches();
        $totalStaff = $this->totalStaff();
        $totalBranchRevenueData = $this->totalRevenue();
        $annualRevenueArray = $totalBranchRevenueData['annualRevenueArray'];
        $monthlyRevenueArray = $totalBranchRevenueData['monthlyRevenueArray'];
        $dailyRevenueArray = $totalBranchRevenueData['dailyRevenueArray'];
        $year = $totalBranchRevenueData['year'];
        $month = $totalBranchRevenueData['month'];
        $minYear = $totalBranchRevenueData['minYear'];
        $totalRevenue = $totalBranchRevenueData['totalRevenue'];
        return view('Owner.Dashboard')->with([
            'totalBranches' => $totalBranches,
            'branchRevenue' => false,
            'totalStaff' => $totalStaff,
            'annualRevenueArray' => $annualRevenueArray,
            'monthlyRevenueArray' => $monthlyRevenueArray,
            'dailyRevenueArray' => $dailyRevenueArray,
            'totalRevenue' => $totalRevenue,
            'year' => $year,
            'month' => $month,
            'minYear' => $minYear,
            'title' => 'dash',
            'branches' => $branches,
            'branches_name' => 'All',
        ]);
    }
    public function branchDashboard($branch_id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }

        $branches = Branch::all();
        $branch = Branch::find($branch_id);

        // $totalBranches = $this->totalBranches($branch_id);
        $totalStaff = $this->totalBranchStaff($branch_id);
        $totalRevenue = $this->totalRevenue();
        $totalBranchRevenueData = $this->totalBranchRevenue($branch_id);
        $annualRevenueArray = $totalBranchRevenueData['annualRevenueArray'];
        $monthlyRevenueArray = $totalBranchRevenueData['monthlyRevenueArray'];
        $dailyRevenueArray = $totalBranchRevenueData['dailyRevenueArray'];
        $year = $totalBranchRevenueData['year'];
        $month = $totalBranchRevenueData['month'];
        $minYear = $totalBranchRevenueData['minYear'];
        $totalRevenue = $totalRevenue['totalRevenue'];
        $totalBranchRevenue = $totalBranchRevenueData['totalRevenue'];
        return view('Owner.Dashboard')->with([
            'totalStaff' => $totalStaff,
            'totalBranches' => false,
            'branchRevenue' => $totalBranchRevenue,
            'annualRevenueArray' => $annualRevenueArray,
            'monthlyRevenueArray' => $monthlyRevenueArray,
            'dailyRevenueArray' => $dailyRevenueArray,
            'totalRevenue' => $totalRevenue,
            'year' => $year,
            'month' => $month,
            'minYear' => $minYear,
            'title' => 'dash',
            'branches' => $branches,
            'branches_name' => $branch->branchLocation,
        ]);
    }

    /*
    |---------------------------------------------------------------|
    |======================= Branch Functions ======================|
    |---------------------------------------------------------------|
    */

    public function viewBranches($owner_id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        $branchData = Branch::all();
        $totalBranches = $this->totalBranches();
        return view('Owner.MyBranches')->with(['branchData' => $branchData, 'totalBranches' => $totalBranches]);
    }
    public function newBranch(Request $req)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }

        $riderOption = $req->has('riderOption') ? true : false;
        $onlineDeliveryOption = $req->has('onlineDeliveryOption') ? true : false;
        $diningTableOption = $req->has('diningTableOption') ? true : false;

        $newBranch = new Branch();
        $newBranch->branch_state = $req->input('branch_state');
        $newBranch->branchLocation = $req->input('branchArea');
        $newBranch->branchName = $req->input('branchname');
        $newBranch->branchCode = $req->input('branchcode');
        $newBranch->address = $req->input('address');

        $newBranch->riderOption = $riderOption;
        $newBranch->onlineDeliveryOption = $onlineDeliveryOption;
        $newBranch->diningTableOption = $diningTableOption;

        $newBranch->owner_id = $req->owner_id;

        $newBranch->save();

        if ($newBranch->save()) {
            return redirect()->back()->with('success', 'Branch Added Successfully');
        } else {
            return redirect()->back()->with('error', 'Branch not added');
        }
    }
    public function updateBranches(Request $req)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }

        $riderOption = $req->has('riderOption') ? true : false;
        $onlineDeliveryOption = $req->has('onlineDeliveryOption') ? true : false;
        $diningTableOption = $req->has('diningTableOption') ? true : false;

        $branchData = Branch::find($req->branch_id);
        $branchData->branch_state = $req->branch_state;
        $branchData->branchLocation = $req->branchArea;
        $branchData->branchName = $req->branchname;
        $branchData->branchCode = $req->branchcode;
        $branchData->address = $req->address;
        $branchData->riderOption = $riderOption;
        $branchData->onlineDeliveryOption = $onlineDeliveryOption;
        $branchData->diningTableOption = $diningTableOption;
        $branchData->save();

        if ($branchData) {
            return redirect()->back()->with('success', 'Branch Update Successfully');
        } else {
            return redirect()->back()->with('error', 'Branch not updated');
        }
    }
    public function deleteBranch($branch_id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        $branchData = Branch::find($branch_id);
        $branchData->delete();

        if ($branchData && !$branchData->delete()) {
            return redirect()->back()->with('success', 'Branch Delete Successfully');
        } else {
            return redirect()->back()->with('error', 'Branch not deleted');
        }
    }

    /*
    |---------------------------------------------------------------|
    |======================== Staff Functions ======================|
    |---------------------------------------------------------------|
    */

    public function viewAddStaff($owner_id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        $branches = Branch::all();
        $staff = User::with('branch')->get();
        return view('Owner.MyStaff')->with(['branches' => $branches, 'Staff' => $staff]);
    }
    public function updateStaffData(Request $req)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        $auth = User::find($req->input('staffId'));
        if ($req->hasFile('updated_profile_picture')) {
            $imageName = null;
            $existingImagePath = public_path('Images/UsersImages') . '/' . $auth->profile_picture;
            File::delete($existingImagePath);

            $image = $req->file('updated_profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Images/UsersImages'), $imageName);
            $auth->profile_picture = $imageName;
        }

        $auth->name = $req->input('name');
        $auth->email = $req->input('email');
        $auth->role = $req->input('role');
        $auth->branch_id = $req->input('branch');

        if ($req->filled('password')) {
            $auth->password = Hash::make($req->input('password'));
        }

        $auth->save();

        if ($auth && $auth->save()) {
            return redirect()->back()->with('success', 'Staff Update Successfully');
        } else {
            return redirect()->back()->with('error', 'Staff not update');
        }
    }
    public function deleteStaffData($id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        $staff = User::find($id);
        $staff->delete();
        if ($staff && !$staff->delete()) {
            return redirect()->back()->with('success', 'Staff delete Successfully');
        } else {
            return redirect()->back()->with('error', 'Staff not deleted');
        }
    }

    public function viewReports($owner_id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        $branch = Branch::all();
        $order = Order::with('items')->get();
        $user = User::where('role', 'salesman')->with('branch')->get();
        return view('Owner.Report')->with([
            'totalOrders' => $order,
            'salesman' => $user,
            'dailyOrders' => null,
            'branches' => $branch,
            'branch_id' => 0,
            'branches_name' => 'All',
        ]);
    }
    public function viewReportPage($branch_id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        $order = Order::where('branch_id', $branch_id)
            ->with('items')
            ->get();
        $branches = Branch::all();
        $branch = Branch::find($branch_id);
        $user = User::where('branch_id', $branch_id)->where('role', 'salesman')->get();

        return view('Owner.Report')->with([
            'totalOrders' => $order,
            'salesman' => $user,
            'dailyOrders' => null,
            'branches' => $branches,
            'branch_id' => $branch_id,
            'branches_name' => $branch->branchLocation,
        ]);
    }

    public function viewSettings($owner_id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        $settingsData = OwnerSetting::where('owner_id', $owner_id)->first();
        return view('Owner.Setting')->with(['settingsData' => $settingsData]);
    }

    public function createThemeSettings(Request $request)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        $newSettings = new OwnerSetting();
        if ($request->hasFile('logoPic')) {
            $uploadedFile = $request->file('logoPic');
            $extension = $uploadedFile->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $uploadedFile->move(public_path('Images/Logos/'), $imageName);

            $newSettings->pos_logo = $imageName;
        }

        $newSettings->pos_primary_color = $request->primary_color;
        $newSettings->pos_secondary_color = $request->secondary_color;
        $newSettings->owner_id = $request->owner_id;
        $newSettings->save();
        if ($newSettings->save())
            return redirect()->back()->with('success', 'Settings Updated');
        else
            return redirect()->back()->with('success', 'Settings not Update');
    }
    public function updateThemeSettings(Request $request)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }

        $owner_id = $request->input('owner_id');
        $setting_id = $request->input('setting_id');

        $setting = OwnerSetting::find($setting_id);
        if ($request->hasFile('logoPic')) {
            $existingImage = public_path("Images/Logos/$setting->pos_logo");
            File::delete($existingImage);

            $newImage = $request->file("logoPic");
            $extension = $newImage->getClientOriginalExtension();
            $newImageName = time() . "." . $extension;
            $newImage->move(public_path("Images/Logos"), $newImageName);
            $setting->pos_logo = $newImageName;
        }

        $setting->pos_primary_color = $request->primary_color;
        $setting->pos_secondary_color = $request->secondary_color;
        $setting->save();
        if ($setting->save())
            return redirect()->back()->with('success', 'Settings Updated');
        else
            return redirect()->back()->with('success', 'Settings not Update');
    }
    public function deleteThemeSettings($id)
    {
        $setting = OwnerSetting::find($id);
        if ($setting->delete()){
            $image =  public_path("Images/Logos/$setting->pos_logo");
            File::delete($image);
            return redirect()->back()->with('success', 'Setting Delete');
        }
        else
            return redirect()->back()->with('error', 'Settings Not Delete');
    }
    public function totalBranches()
    {
        $totalBranches = Branch::count();
        // session(['totalBranches' => $totalBranches]);
        return $totalBranches;
    }
    public function totalStaff()
    {
        $totalStaff = User::where('role', '<>', 'owner')->count();
        session(['totalStaff' => $totalStaff]);
        return $totalStaff;
    }
    public function totalRevenue()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $dailyBranchRevenues = Order::where('status', 1)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();


        $monthlyBranchRevenues = Order::where('status', 1)
            ->whereYear('created_at', $year)
            ->get();

        $annualBranchRevenues = Order::where('status', 1)
            ->get();

        $dailyRevenueArray = [];
        $monthlyRevenueArray = [];
        $annualRevenueArray = [];
        $totalRevenue = 0;

        foreach ($dailyBranchRevenues as $revenue) {
            $branch_id = $revenue->branch_id;
            $date = $revenue->created_at->format('Y-m-d');

            $revenueValue = (int) str_replace([' Pkr', 'Rs. ', ','], '', $revenue->total_bill);
            if (!isset($dailyRevenueArray[$branch_id])) {
                $dailyRevenueArray[$branch_id] = array_fill(0, Carbon::create($year, $month)->daysInMonth, 0);
            }
            $dayIndex = Carbon::parse($date)->day - 1;
            $dailyRevenueArray[$branch_id][$dayIndex] += $revenueValue;
            $totalRevenue += $revenueValue;
        }

        foreach ($monthlyBranchRevenues as $revenue) {
            $branch_id = $revenue->branch_id;
            $date = $revenue->created_at->format('Y-m');
            $revenueValue = (int) str_replace([' Pkr', 'Rs. ', ','], '', $revenue->total_bill);

            if (!isset($monthlyRevenueArray[$branch_id])) {
                $monthlyRevenueArray[$branch_id] = array_fill(0, 12, 0);
            }
            $monthIndex = Carbon::parse($date)->month - 1;
            $monthlyRevenueArray[$branch_id][$monthIndex] += $revenueValue;
        }

        foreach ($annualBranchRevenues as $revenue) {
            $branch_id = $revenue->branch_id;
            $yearKey = $revenue->created_at->format('Y');
            $revenueValue = (int) str_replace([' Pkr', 'Rs. ', ','], '', $revenue->total_bill);

            if (!isset($annualRevenueArray[$branch_id])) {
                $annualRevenueArray[$branch_id] = [];
            }

            if (!isset($annualRevenueArray[$branch_id][$yearKey])) {
                $annualRevenueArray[$branch_id][$yearKey] = 0;
            }

            $annualRevenueArray[$branch_id][$yearKey] += $revenueValue;
        }

        $minYear = Order::min(DB::raw('YEAR(created_at)'));
        $formattedTotalRevenue = $this->formatRevenue($totalRevenue);
        session(['totalRevenue' => $formattedTotalRevenue]);

        return [
            'dailyRevenueArray' => $dailyRevenueArray,
            'monthlyRevenueArray' => $monthlyRevenueArray,
            'annualRevenueArray' => $annualRevenueArray,
            'totalRevenue' => $formattedTotalRevenue,
            'year' => $year,
            'month' => $month,
            'minYear' => $minYear,
        ];
    }


    public function totalBranchStaff($branch_id)
    {
        $totalStaff = User::where('branch_id', $branch_id)->count();
        session(['totalStaff' => $totalStaff]);
        return $totalStaff;
    }
    public function totalBranchRevenue($branch_id)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $dailyBranchRevenues = Order::where('status', 1)
            ->whereYear('created_at', $year)
            ->where('branch_id', $branch_id)
            ->whereMonth('created_at', $month)
            ->get();


        $monthlyBranchRevenues = Order::where('status', 1)
            ->whereYear('created_at', $year)
            ->where('branch_id', $branch_id)
            ->get();

        $annualBranchRevenues = Order::where('status', 1)
            ->where('branch_id', $branch_id)
            ->get();

        $dailyRevenueArray = [];
        $monthlyRevenueArray = [];
        $annualRevenueArray = [];
        $totalRevenue = 0;

        foreach ($dailyBranchRevenues as $revenue) {
            $branch_id = $revenue->branch_id;
            $date = $revenue->created_at->format('Y-m-d');

            $revenueValue = (int) str_replace([' Pkr', 'Rs. ', ','], '', $revenue->total_bill);
            if (!isset($dailyRevenueArray[$branch_id])) {
                $dailyRevenueArray[$branch_id] = array_fill(0, Carbon::create($year, $month)->daysInMonth, 0);
            }
            $dayIndex = Carbon::parse($date)->day - 1;
            $dailyRevenueArray[$branch_id][$dayIndex] += $revenueValue;
            $totalRevenue += $revenueValue;
        }

        foreach ($monthlyBranchRevenues as $revenue) {
            $branch_id = $revenue->branch_id;
            $date = $revenue->created_at->format('Y-m');
            $revenueValue = (int) str_replace([' Pkr', 'Rs. ', ','], '', $revenue->total_bill);

            if (!isset($monthlyRevenueArray[$branch_id])) {
                $monthlyRevenueArray[$branch_id] = array_fill(0, 12, 0);
            }
            $monthIndex = Carbon::parse($date)->month - 1;
            $monthlyRevenueArray[$branch_id][$monthIndex] += $revenueValue;
        }

        foreach ($annualBranchRevenues as $revenue) {
            $branch_id = $revenue->branch_id;
            $yearKey = $revenue->created_at->format('Y');
            $revenueValue = (int) str_replace([' Pkr', 'Rs. ', ','], '', $revenue->total_bill);

            if (!isset($annualRevenueArray[$branch_id])) {
                $annualRevenueArray[$branch_id] = [];
            }

            if (!isset($annualRevenueArray[$branch_id][$yearKey])) {
                $annualRevenueArray[$branch_id][$yearKey] = 0;
            }

            $annualRevenueArray[$branch_id][$yearKey] += $revenueValue;
        }

        $minYear = Order::min(DB::raw('YEAR(created_at)'));
        $formattedTotalRevenue = $this->formatRevenue($totalRevenue);
        session(['totalRevenue' => $formattedTotalRevenue]);

        return [
            'dailyRevenueArray' => $dailyRevenueArray,
            'monthlyRevenueArray' => $monthlyRevenueArray,
            'annualRevenueArray' => $annualRevenueArray,
            'totalRevenue' => $formattedTotalRevenue,
            'year' => $year,
            'month' => $month,
            'minYear' => $minYear,
        ];
    }


    private function formatRevenue($revenue)
    {
        $abbreviations = array(
            12 => 'T', // Trillion
            9 => 'B', // Billion
            6 => 'M', // Million
            3 => 'k', // Thousand
        );
        foreach ($abbreviations as $exp => $abbr) {
            if ($revenue >= pow(10, $exp)) {
                return number_format($revenue / pow(10, $exp), 1) . $abbr;
            }
        }
        return $revenue;
    }
    public function addNewBranchIndex()
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }
        return view('Owner.AddNewBranch');
    }
}