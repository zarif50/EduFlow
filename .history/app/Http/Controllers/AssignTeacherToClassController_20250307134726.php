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
    public function index(){
        $data['classes'] = Classes::all();
        $data['teachers']=User::where('role','teacher')->latest()->get();
        return view('admin.assign_teacher.form',$data);
    }
    public function findSubject(Request $request){
           $class_id =$request->class_id;
           $subjects= AssignSubjectToClass::with('subject')->where('class_id', $class_id)->get();
          //$subjects = AssignSubjectToClass::where('class_id', $class_id)->get();
          //$subjects = AssignSubjectToClass::with(['subject', 'otherRelationship'])->where('class_id', $class_id)->get();

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

    //public function read(){
     //   $data['assign_teachers']=AssignTeacherToClass::with()->latest('class')->get();
      //  dd($data);
   // }

   public function read(){
    $data['assign_teachers'] = AssignTeacherToClass::with(['class','subject' 'teacher'])
                                                    ->latest('class_id') // Use class_id or another column name
                                                    ->get();
    dd($data);
}



}

