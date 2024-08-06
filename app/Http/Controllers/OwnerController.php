<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{

    public function viewOwnerDashboard($owner_id)
    {
        if (!session()->has('owner')) {
            return redirect()->route('viewLoginPage');
        }

        $branches = Branch::with('users')->get();

        $branchData = $branches->map(function ($branch) {
            $branch->branchManager = $branch->users->where('role', 'branchManager')->first();
            $branch->unsetRelation('users');
            return $branch;
        });

        $totalCompanies = $this->totalBranches();
        $totalStaff = $this->totalStaff();
        $totalRevenue = $this->totalRevenue();
        return view('Owner.Dashboard')->with([
            'totalCompanies' => $totalCompanies,
            'branchRevenue' => false,
            'totalStaff' => $totalStaff,
            'totalRevenue' => $totalRevenue,
            'branchData' => $branchData
        ]);
    }

    /*
    |---------------------------------------------------------------|
    |======================= Branch Functions ======================|
    |---------------------------------------------------------------|
    */

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
        $newBranch->branch_city = $req->input('branch_city');
        $newBranch->company_name = $req->input('company_name');
        $newBranch->branch_name = $req->input('branch_name');
        $newBranch->branch_code = $req->input('branch_code');
        $newBranch->branch_address = $req->input('branch_address');

        $newBranch->riderOption = $riderOption;
        $newBranch->onlineDeliveryOption = $onlineDeliveryOption;
        $newBranch->DiningOption = $diningTableOption;

        if ($newBranch->save()) {
            $newManager = new User();
            $newManager->email = $req->input('manager_email');
            $newManager->password = Hash::make($req->input('password'));
            $newManager->branch_id = $newBranch->id;
            $newManager->save();
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
        $branchData->branch_state = $req->input('branch_state');
        $branchData->branch_city = $req->input('branch_city');
        $branchData->company_name = $req->input('company_name');
        $branchData->branch_name = $req->input('branch_name');
        $branchData->branch_code = $req->input('branch_code');
        $branchData->branch_address = $req->input('branch_address');
        $branchData->riderOption = $riderOption;
        $branchData->onlineDeliveryOption = $onlineDeliveryOption;
        $branchData->diningOption = $diningTableOption;
        if ($branchData->save()) {
            $manager = User::find($req->branch_manager_id);
            $manager->email = $req->input('manager_email');
            $manager->password = Hash::make($req->input('password'));
            $manager->save();
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
    public function showBranchStats($branch_id)
    {
        $branch = Branch::find($branch_id);
        if ($branch->onlineDeliveryOption === 0) {
            return redirect()->back()->with('warning', 'The Online Option for this Branch is disabled.');
        }
        $orders = Order::with('branch')->where('branch_id', $branch_id)->whereIn('ordertype', ['online', 'Online', 'ONLINE'])->get();
        $orders->branch_details = $branch;
        return redirect()->back()->with('Orders', $orders);
    }

    /*
    |---------------------------------------------------------------|
    |======================== Staff Functions ======================|
    |---------------------------------------------------------------|
    */

    public function totalBranches()
    {
        $totalBranches = Branch::distinct('company_name')->count('company_name');
        return $totalBranches;
    }
    public function totalStaff()
    {
        $totalStaff = User::where('role', '<>', 'owner')->count();
        return $totalStaff;
    }
    public function totalRevenue()
    {
        $TotalRevenues = Order::where('status', 1)->get();
        $totalRevenue = 0;
        foreach ($TotalRevenues as $revenue) {
            $bill = (float) str_replace('Rs. ', '', $revenue->total_bill) + $revenue->taxes - $revenue->discount;
            $totalRevenue += $bill;
        }
        return $totalRevenue;
    }
}