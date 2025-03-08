<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminService
{
    // Handle Admin Authentication
    public function authenticate($email, $password)
    {
        return Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);
    }

    // Check if the user is authorized to access the admin dashboard
    public function checkAdminRole()
    {
        $user = Auth::guard('admin')->user();
        return $user && $user->role == 'admin';
    }

    // Register a new admin user
    public function registerAdminUser($name, $email, $password, $classId, $academicYearId)
    {
        $user = new User();
        $user->name = $name;
        $user->role = 'admin';
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->class_id = $classId;
        $user->academic_year_id = $academicYearId;
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();
        return $user;
    }

    // Handle Admin Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
    }
}
