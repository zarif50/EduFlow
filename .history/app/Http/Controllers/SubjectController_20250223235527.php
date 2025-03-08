<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subject.form');
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
            'name'=>'required',
            'type'=>'required',

        ]);
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->type = $request->type;
        
        //$subject->string('status')->deafult('active');
        //$table->string('status')->nullable();
        $subject->status = $request->status ?? '1'; 
        //$subject->save();
        $subject->save();
        return redirect()->route('subject.create')->with('success','Subject added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
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
    public function destroy(Subject $subject)
    {
        //
    }

    public function read()
    {
        $data['subjects']=Subject::latest()->get();
        //dd($data);
        return view('admin.subject.table',$data);

    }
    public function delete($id)
       {
        $subject =Subject::find($id);
        $subject->delete();
        return redirect()->route('subject.read')->with('success','Subject deleted Successfully');
       }

       public function edit($id)
          {
            $data['subject'] =Subject::find($id);
            return view('admin.subject.edit_form',$data);

          }
          public function update(Request $request,$id)
          {
              $subject =new Subject();
          }
}
