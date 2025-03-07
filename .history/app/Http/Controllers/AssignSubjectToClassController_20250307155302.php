<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use Illuminate\Http\Request;
use App\Models\Classes;  // Fixed the incorrect ClassModel reference
use App\Models\Subject;

class AssignSubjectToClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.assign_subject.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "class_id" => "required",
            "subject_id" => "required",
        ]);

        $class_id = $request->class_id;
        $subject_ids = $request->subject_id;

        foreach ($subject_ids as $subject_id) {
            AssignSubjectToClass::updateOrCreate(
                [
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                ],
                [
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                ]
            );
        }

        return redirect()->route('assign-subject.read')->with('success', 'Subject assigned to a class added successfully');
    }

    /**
     * Show the edit form for the specified resource.
     */
    public function edit($id)
    {
        $data['assign_subject'] = AssignSubjectToClass::find($id);
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();

        return view('admin.assign_subject.edit_form', $data);
    }

    /**
     * Read and display assigned subjects with filtering.
     */
    public function read(Request $request)
    {
        $query = AssignSubjectToClass::with(['class', 'subject']);

        $classId = $request->get('class_id') ?? $request->get('class-id'); // Allow both formats

        if (!empty($classId)) {
            $query->where('class_id', (int) $classId);
        }

        $data['assign_subjects'] = $query->get();
        $data['classes'] = Classes::all();

        return view('admin.assign_subject.table', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = AssignSubjectToClass::find($id);

        if (!$data) {
            return redirect()->route('assign-subject.read')->with('error', 'Assignment not found');
        }

        $data->class_id = $request->class_id;
        $data->subject_id = $request->subject_id;
        $data->save();

        return redirect()->route('assign-subject.read')->with('success', 'Subject assigned to a class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $res = AssignSubjectToClass::find($id);

        if ($res) {
            $res->delete();
            return redirect()->route('assign-subject.read')->with('success', 'Subject assigned to a class deleted successfully');
        }

        return redirect()->route('assign-subject.read')->with('error', 'Subject assignment not found');
    }
}
