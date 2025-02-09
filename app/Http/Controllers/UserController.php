<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('student.login');
    }
    public function authenticate(Request $request)
    {

       if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
       {

        if(Auth::user()->role!='student'){
            Auth::logout();
            return redirect()->route('student.login')->with('error','Unauthorized user.Access denied');
         }
         return redirect()->route('student.dashboard');
       }
       else{
        return redirect()->route('student.login')->with('error','Something went Wrong');

       }

    }
    public function dashboard()
    {
        return view ('student.dashboard');



    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('student.login')->with('error','Logout Successfully!');

    }
}
