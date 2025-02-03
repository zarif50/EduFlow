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
        return redirect()->route('fee-structure.create')->query()->with('success',' Fess Structure Added Successfully');
    }
    public function read(Request)
    {

       $feeStructure =FeeStructure::with (['FeeHead','AcademicYear','Classes'])->latest();
       if($feeStructure->filled('class_id');){
        $feestructure->where('class_id',$request->get('class_id'));
       }
        $data['feeStructure']=$feeStructure->get();
        $data['classes'] =Classes::all();
        $data['academic_year'] =AcademicYear::all();
        return view('admin.fee-structure.fee-structure_list',$data);
    }

    public function delete($id)
    {

        $data=FeeStructure::find($id);
        $data->delete();
        return redirect()->back()->with('success','Fee Structure Deleted Successfully');
    }

    public function edit($id)
    {

        $data['fee']=FeeStructure::find($id);
        $data['classes']= Classes::all();
        $data['academic_years']= AcademicYear::all();
        $data['fee_heads']=FeeHead::all();
        return view ('admin.fee-structure.edit-fee-structure',$data);

    }

    public function update(Request $request,$id){

        $fee =FeeStructure::find($id);
        $fee->class_id =$request->class_id;
        $fee->academic_year_id =$request->academic_year_id;
        $fee->fee_head_id =$request->fee_head_id;
        $fee->april =$request->april;
        $fee->may =$request->may;
        $fee->june=$request->june;
        $fee->july =$request->july;
        $fee->august =$request->august;
        $fee->september =$request->september;
        $fee->october =$request->october;
        $fee->november=$request->november;
        $fee->december =$request->december;
        $fee->january =$request->january;
        $fee->february =$request->february;
        $fee->march =$request->march;
        $fee->update();
        return redirect()->route('fee-structure.read')->with('success','Fee Structure updates successfully');



    }
   
}
