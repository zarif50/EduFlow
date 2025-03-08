<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Announcement;
use Illuminate\Http\Request;

class UserService
{
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role != 'student') {
                Auth::logout();
                return ['error' => 'Unauthorized user. Access denied'];
            }
            return ['redirect' => route('student.dashboard')];
        } else {
            return ['error' => 'Something went wrong'];
        }
    }

    public function getLatestAnnouncement()
    {
        return Announcement::where('type', 'student')->latest()->limit(1)->get();
    }

    public function logout()
    {
        Auth::logout();
        return ['redirect' => route('student.login'), 'error' => 'Logout Successfully!'];
    }

    public function changePassword($old_password, $new_password)
    {
        $user = User::find(Auth::user()->id);

        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password); // Ensure password is hashed
            $user->update();
            return ['success' => 'Password changed successfully'];
        } else {
            return ['error' => 'Old password does not match'];
        }
    }
}
