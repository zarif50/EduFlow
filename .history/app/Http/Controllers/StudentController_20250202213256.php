<?php

namespace App\Http\Controllers;
use App\Models\Aca
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
      echo "ok";
   }
}
