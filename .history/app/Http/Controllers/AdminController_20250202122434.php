<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function authenticate(Request $req){
               $req->validate([
                'email'=>'required',
                'password'=>'required'
               ]);
             if(Auth::guard('admin')->attempt(['email'=>$req->email,'password'=>$req->password]))
             {
                 if(Auth::guard('admin')->user()->role!='admin'){
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error','Unauthorized user.Access denied');
                 }
                 return redirect()->route('admin.dashboard');
             }
             else{
                return redirect()->route('admin.login')->with('error','Something went Wrong');
             }
    }
    public function register(){
        $user = new user();
        $user->name='Admin';
        $user->role='admin';
        $user->email='admin@gmail.com';
        $user->password= Hash::make('admin');
        $user->class_id=1;
        $user->aca
        $user->save();
       
        return redirect()->route('admin.login')->with('success','User Created Successfully');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success','User Logout Successfully');
    }
    public function form(){
        return view('admin.form');
    }
    public function table(){
        return view('admin.table');
    }
}
