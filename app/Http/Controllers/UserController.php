<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword()
    {

            return view('student.change_password');

    }

public function updatePassword(Request $request)
{

        $request->validate([

            'old_password'=>'required',
            'new_password'=>'required',
            'password_confirmation'=>'required|same:new_password',

        ]);
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user = User::find(Auth::user()->id);
        if(Hash::check($old_password,$user->password))
        {
            $user->password =$new_password;
            $user->update();
            return redirect()->back()->with('success','Password changed successfully');

        }
        else{

            return redirect()->back()->with('error','Old password does not match');

        }
}


}
