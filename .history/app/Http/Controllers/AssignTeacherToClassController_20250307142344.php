<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use App\Models\AssignSubjectToClass;
use App\Models\AssignTeacherToClass;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AssignTeacherToClassController extends Controller
{
    // Method to display the list of assigned teachers
    public function index(Request $request)
    {
        // Fetch all classes from the Classes model
        $classes = Classes::all();  // Ensure this is the correct model and it's fetching the data

        // Fetch the assigned teachers with related class, subject, and teacher info
        $assign_teachers = AssignTeacherToClass::with(['class', 'subject', 'teacher'])
            ->latest('class_id')
            ->get();

        // Return the view with the fetched data
        return view('admin.assign_teacher.list', compact('assign_teachers', 'classes'));
    }

    // Method to find subjects based on the class ID
    public function findSubject(Request $request)
    {
        $class_id = $request->class_id;
        $subjects = AssignSubjectToClass::with('subject')->where('class_id', $class_id)->get();

        return response()->json([
            'status' => true,
            'subjects' => $subjects
        ]);
    }

    // Method to store the teacher assignments
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
        ]);

        // Create or update the teacher assignment
        AssignTeacherToClass::updateOrCreate(
            [
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
            ],
            [
                'teacher_id' => $request->teacher_id,
            ]
        );

        // Redirect back with success message
        return redirect()->route('assign-teacher.create')->with('success', 'Teacher Assigned Successfully');
    }

    // Method to display the list of assigned teachers (alternative to index)
    // public function showList()
    // {
    //     // Fetch assigned teachers with the related data
    //     $assign_teachers = AssignTeacherToClass::with(['class', 'subject', 'teacher'])
    //         ->latest('class_id') // You can change this column name if needed
    //         ->get();

    //     // Return the view with the fetched data
    //     return view('admin.assign_teacher.list', compact('assign_teachers'));
    // }

    public function showList()
{
    $assign_teachers = AssignTeacherToClass::with(['class', 'subject', 'teacher'])
        ->latest('class_id') // You can change this column name if needed
        ->get();

    return view('admin.assign_teacher.list', compact('assign_teachers'));
}

}
