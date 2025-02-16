<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
   public function index()
   {
   $data['classes']= Classes::all();
   $data['academic_years']= AcademicYear::all();
    return view('admin.student.student');
   }

   public function store()
}
