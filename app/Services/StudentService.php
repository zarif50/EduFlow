<?php

namespace App\Services;

use App\Models\User;
use App\Models\AcademicYear;
use App\Models\Classes;
use Illuminate\Support\Facades\Hash;

class StudentService
{
    // Function to store a new student
    public function storeStudent($data)
    {
        $user = new User();
        $user->academic_year_id = $data['academic_year_id'];
        $user->class_id = $data['class_id'];
        $user->name = $data['name'];
        $user->father_name = $data['father_name'];
        $user->mother_name = $data['mother_name'];
        $user->admission_date = $data['admission_date'];
        $user->dob = $data['dob'];
        $user->mobno = $data['mobno'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = 'student';
        $user->save();

        return $user;
    }

    // Function to retrieve all students with filters
    public function getAllStudents($filters)
    {
        $query = User::with(['studentClass', 'studentAcademicYear'])
            ->where('role', 'student')
            ->latest('id');

        if ($filters['academic_year_id'] ?? false) {
            $query->where('academic_year_id', $filters['academic_year_id']);
        }

        if ($filters['class_id'] ?? false) {
            $query->where('class_id', $filters['class_id']);
        }

        return $query->get();
    }

    // Function to get a student by ID
    public function getStudentById($id)
    {
        return User::find($id);
    }

    // Function to update student details
    public function updateStudent($id, $data)
    {
        $user = User::find($id);
        $user->academic_year_id = $data['academic_year_id'];
        $user->class_id = $data['class_id'];
        $user->name = $data['name'];
        $user->father_name = $data['father_name'];
        $user->mother_name = $data['mother_name'];
        $user->admission_date = $data['admission_date'];
        $user->dob = $data['dob'];
        $user->mobno = $data['mobno'];
        $user->email = $data['email'];
        $user->save();

        return $user;
    }

    // Function to delete a student
    public function deleteStudent($id)
    {
        $student = User::find($id);
        if ($student) {
            $student->delete();
        }

        return true;
    }
}
