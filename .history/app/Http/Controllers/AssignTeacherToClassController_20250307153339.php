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
        // Fetch all classes
        $classes = Classes::all();

        // Fetch assigned teachers with related class, subject, and teacher info
        $assign_teachers = AssignTeacherToClass::with(['class', 'subject', 'teacher'])
            ->latest('class_id')
            ->get();

        // Return the view with data
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
        // Validate request data
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:assign_subject_to_classes,id',
            'teacher_id' => 'required|exists:users,id',
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

    // Method to show the list of assigned teachers
    public function showList()
    {
        // Fetching the classes
        $classes = Class::all();  // Adjust this according to your model if needed
    
        // Fetching the assign_teachers with related data
        $assign_teachers = AssignTeacherToClass::with(['class', 'subject', 'teacher'])
            ->latest('class_id')
            ->get();
    
        // Passing both variables to the view
        return view('admin.assign_teacher.list', compact('assign_teachers', 'classes'));
    }
    // Method to read a single teacher assignment
    public function read($id)
    {
        // Fetch the assignment with associated relations
        $assignment = AssignTeacherToClass::with(['class', 'subject', 'teacher'])->find($id);
        
        // If the assignment is not found, redirect with an error message
        if (!$assignment) {
            return redirect()->route('assign-teacher.list')->with('error', 'Assignment not found');
        }
    
        // Return the view with the assignment data
        return view('admin.assign_teacher.read', compact('assignment'));
    }
}
