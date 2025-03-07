<?php

namespace App\Http\Controllers;
use App\Models\Classes;
use App\Models\User;
use app\Models\AssignSubjectToClass;
use app\Models\AssignTeacherToClass;
use Illuminate\Http\Request;

class AssignTeacherToClassController extends Controller
{
    public function index(){
        $data['classes'] = Classes::all();
        $data['teachers']=User::where('role','teacher')->latest()->get();
        return view('admin.assign_teacher.form',$data);
    }
    public function findSubject(Request $request){
           $class_id =$request->class_id;
           $subjects= AssignSubjectToClass::with('subject')->where('class_id', $class_id)->get();
           return response()->json([
            'status'=>true,
            'subjects'=>$subjects
           ]);
    }
    public function store(Request $request){
        $request->validate([
            'class_id'=>'required',
            'subject_id'=>'required',
            'teacher_id'=>'required',
        ]);
        AssignTeacherToClass::updateOrCreate(
            [
                  'class_id'=>$request->class_id,
                  'subject_id'=>$request->subject_id,
            ],
            [
                'class_id'=>$request->class_id,
                'subject_id'=>$request->subject_id,
                'teacher_id'=>$request->teacher_id,

            ]
            );
             return redirect()->route('assign-teacher.create')->with('success','Teacher Assigned Successfully');


    }

    public function read(){
        $data['assign_teachers']=AssignTeacherToClass::latest()->get();
        dd
    }

}

