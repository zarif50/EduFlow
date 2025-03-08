<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TeacherService
{
    // Function to store a new teacher
    public function storeTeacher($data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->father_name = $data['father_name'];
        $user->mother_name = $data['mother_name'];
        $user->dob = $data['dob'];
        $user->mobno = $data['mobno'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = 'teacher';
        $user->save();

        return $user;
    }

    // Function to retrieve all teachers
    public function getAllTeachers()
    {
        return User::where('role', 'teacher')->latest()->get();
    }

    // Function to find a teacher by ID
    public function getTeacherById($id)
    {
        return User::find($id);
    }

    // Function to update teacher details
    public function updateTeacher($id, $data)
    {
        $teacher = User::find($id);
        $teacher->name = $data['name'];
        $teacher->father_name = $data['father_name'];
        $teacher->mother_name = $data['mother_name'];
        $teacher->dob = $data['dob'];
        $teacher->mobno = $data['mobno'];
        $teacher->email = $data['email'];
        $teacher->save();

        return $teacher;
    }

    // Function to delete a teacher
    public function deleteTeacher($id)
    {
        $teacher = User::find($id);
        $teacher->delete();

        return true;
    }

    // Function to authenticate teacher login
    public function authenticateTeacher($email, $password)
    {
        if (Auth::guard('teacher')->attempt(['email' => $email, 'password' => $password])) {
            if (Auth::guard('teacher')->user()->role != 'teacher') {
                Auth::guard('teacher')->logout();
                return false;
            }
            return true;
        }
        return false;
    }

    // Function to logout a teacher
    public function logoutTeacher()
    {
        Auth::guard('teacher')->logout();
    }
}
