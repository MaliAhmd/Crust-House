<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('Auth.Login');
    }

    public function registrationIndex()
    {
        return view('Auth.Registration');
    }

    public function register(Request $req)
    {
        
        dd($req->all());

        $existingChef = User::where('role','chef')->where('branch_id', $req->branch)->first();
        if($existingChef && $existingChef->role == $req->role){
            return redirect()->back()->with('error', 'Chef Already exist in this branch');
        }

        $existingUser = User::all();
        foreach ($existingUser as $user) {
            if($user->email == $req->input('email')){
                return redirect()->back()->with('error', 'Email already exist');
            }
        } 
        $user = new User();

        if ($req->hasFile('profile_picture')) {
            $image = $req->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Images/UsersImages'), $imageName);
            $user->profile_picture = $imageName;
        } else {
            $user->profile_picture = null;
        }

        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = $req->role;
        $user->branch_id = $req->branch;
        $user->password = Hash::make($req->password);
        $user->save();

        if ($req->has('role')) {
            return redirect()->back()->with('success', 'User registered successfully');
        } else {
            return redirect()->route('viewLoginPage')->with('success', 'User registered successfully');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if ($user && Hash::check($request->password, $user->password)) {
            session(['username' => $user->name, 'profile_pic' => $user->profile_picture]);
            
            if ($user->role === 'owner') {
                session()->put('owner', true);
                session()->put('owner_id', $user->id);
                return redirect()->route('dashboard', ['owner_id' => $user->id]);
            } else if ($user->role === 'branchManager') {

                session()->put('id', $user->id);
                session()->put('branch_id', $user->branch_id);
                session()->put('branchManager', true);
                return redirect()->route('managerdashboard', ['id' => $user->id, 'branch_id'=> $user->branch_id]);
            } else if ($user->role === 'salesman') {
                session()->put('salesman', true);
                return redirect()->route('salesman_dashboard', ['id' => $user->id, 'branch_id'=> $user->branch_id]);
            } else if ($user->role === 'chef') {
                session()->put('chef', true);
                return redirect()->route('chef_dashboard', ['user_id' => $user->id, 'branch_id'=> $user->branch_id]);
            }  
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        session()->forget(['username','owner','ThemeSettings','owner_id','branchManager', 'salesman','chef' ,'id', 'branch_id']);
        return redirect()->route('viewLoginPage');
    }
}
