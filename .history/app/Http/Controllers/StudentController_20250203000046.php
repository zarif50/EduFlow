<?php

namespace App\Http\Controllers;
use App\Models\AcademicYear;
use App\Models\Classes;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   public function index()
   {
   $data['classes']= Classes::all();
   $data['academic_years']= AcademicYear::all();
    return view('admin.student.student',$data);
   }

   public function store(Request $request){
      $request->validate([
         'academic_year_id'=>'required',
         'class_id'=>'required',
         'name'=>'required',
         'father_name'=>'required',
         'mother_name'=>'required',
         'admission_date'=>'required',
         'dob'=>'required',
         'mobno'=>'required',
         'email'=>'required',
      ]);
   }
}
