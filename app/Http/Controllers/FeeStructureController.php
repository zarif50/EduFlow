<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\FeeHead;
use App\Models\FeeStructure;


use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index(){
        $data['classes']= Classes::all();
        $data['academic_years']= AcademicYear::all();
        $data['fee_heads']=FeeHead::all();
        return view('admin.fee-structure.fee-structure',$data);
    }
    public function store(Request $request){
       // $fee->structure = new FeeStructure();
        $request->validate([
            'academic_year_id'=>"required",
            'class_id'=>"required",
            'fee_head_id'=>"required"
        ]);
        FeeStructure::create($request->all());
        return redirect()->route('fee-structure.create')->with('success',' Fess Structure Added Successfully');
    }
    
}
