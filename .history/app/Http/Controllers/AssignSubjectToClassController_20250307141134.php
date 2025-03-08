<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Subject;

class AssignSubjectToClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $classes = ClassModel::all();
    //     $data['classes'] =Classes::all();
    //     $data['subjects']=Subject::all();
    //    return view('admin.assign_subject.form',$data);
    // }


    public function index(Request $request)
    {
        // Fetch all classes from the Classes model
        $classes = Classes::all();  // Use the correct model name here
    
        // Apply filtering based on class_id if present
        $assign_teachers = AssignTeacher::when($request->class_id, function($query) use ($request) {
            return $query->where('class_id', $request->class_id);
        })->get();
    
        // Prepare data to pass to the view
        $data = [
            'classes' => $classes, // This ensures $classes is passed to the view
            'assign_teachers' => $assign_teachers,
            'subjects' => Subject::all(),
        ];
    
        // Return the view with data
        return view('admin.assign_teacher.list', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "class_id"=>"required",
            "subject_id"=>"required",

        ]);
        $class_id =$request->class_id;
        $subject_id=$request->subject_id;
        //dd($subject_id);
        foreach($subject_id as $subject_id)
            {
                AssignSubjectToClass::updateOrCreate(
                    [
                          'class_id'=>$class_id,
                          'subject_id'=>$subject_id,
                    ],
                    [
                        'class_id'=>$class_id,
                        'subject_id'=>$subject_id,

                    ]
                    );
            }
            return redirect()->route('assign-subject.read')->with('success','Subject assigned to a class added successfully');
         }


    public function show(AssignSubjectToClass $assignSubjectToClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function delete( $id)
    {
        $res =AssignSubjectToClass::find($id);
        $res ->delete();
        return redirect()->route('assign-subject.read')->with('success','Subject assigned to a class deleted successfully');
    }
    public function edit( $id)
    {
        $data['assign_subject'] =AssignSubjectToClass::find($id);
        $data['classes'] =Classes::all();
        $data['subjects']=Subject::all();

        return view('admin.assign_subject.edit_form',$data);
    }

    public function read(Request $request)
    {
        $query = AssignSubjectToClass::with(['class', 'subject']);

        $classId = $request->get('class_id') ?? $request->get('class-id'); // Check both versions

        if (!empty($classId)) {
            $query->where('class_id', (int) $classId);
        }

        $data['assign_subjects'] = $query->get();
        $data['classes'] = Classes::all();

        return view('admin.assign_subject.table', $data);
    }

    public function update(Request $request,$id)
    {


        $data=AssignSubjectToClass::find($id);
        $data->class_id =$request->class_id;
        $data->subject_id =$request->subject_id;
        $data->update();
        return redirect()->route('assign-subject.read')->with('success','Subject assigned to a class updated successfully');



    }

}
