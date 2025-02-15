<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    // Show login page
    public function index(){
        return view('admin.login');
    }

    // Dynamic authentication method
    public function authenticate(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login for any user role
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            $user = Auth::user();

            // Redirect based on role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'teacher':
                    return redirect()->route('teacher.dashboard');
                case 'student':
                    return redirect()->route('student.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Unauthorized user. Access denied.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Invalid email or password.');
        }
    }

    // Admin registration (Prevents duplicate registration)
    public function register(){
        // Check if admin already exists
        $existingUser = User::where('email', 'admin@gmail.com')->first();

        if ($existingUser) {
            return redirect()->route('admin.login')->with('error', 'Admin already exists!');
        }

        // Create new admin
        $user = new User();
        $user->name = 'Admin';
        $user->role = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('admin'); // Secure hashed password
        $user->class_id = 1;
        $user->academic_year_id = 1;
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();

        return redirect()->route('admin.login')->with('success', 'Admin created successfully');
    }

    // Admin dashboard
    public function dashboard(){
        return view('admin.dashboard');
    }

    // Logout method
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'User logged out successfully');
    }

    // Other pages
    public function form(){
        return view('admin.form');
    }

    public function table(){
        return view('admin.table');
    }
}
