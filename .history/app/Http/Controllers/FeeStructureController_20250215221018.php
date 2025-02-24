<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\FeeHead;
use App\Models\FeeStructure;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index() {
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['fee_heads'] = FeeHead::all();
        return view('admin.fee-structure.fee-structure', $data);
    }

    public function store(Request $request) {
        $request->validate([
            'academic_year_id' => "required|exists:academic_years,id",
            'class_id' => "required|exists:classes,id",
            'fee_head_id' => "required|exists:fee_heads,id"
        ]);

        $feeStructure = new FeeStructure();
        $feeStructure->class_id = $request->class_id;
        $feeStructure->academic_year_id = $request->academic_year_id;
        $feeStructure->fee_head_id = $request->fee_head_id;
        $feeStructure->april = $request->april ?? 0;
        $feeStructure->may = $request->may ?? 0;
        $feeStructure->june = $request->june ?? 0;
        $feeStructure->july = $request->july ?? 0;
        $feeStructure->august = $request->august ?? 0;
        $feeStructure->september = $request->september ?? 0;
        $feeStructure->october = $request->october ?? 0;
        $feeStructure->november = $request->november ?? 0;
        $feeStructure->december = $request->december ?? 0;
        $feeStructure->january = $request->january ?? 0;
        $feeStructure->february = $request->february ?? 0;
        $feeStructure->march = $request->march ?? 0;
        $feeStructure->save();

        return redirect()->route('fee-structure.index')->with('success', 'Fee Structure Added Successfully');
    }

    public function read(Request $request) {
        $feeStructure = FeeStructure::with(['FeeHead', 'AcademicYear', 'Classes'])
            ->when($request->filled('class_id'), function ($query) use ($request) {
                return $query->where('class_id', $request->class_id);
            })
            ->when($request->filled('academic_year_id'), function ($query) use ($request) {
                return $query->where('academic_year_id', $request->academic_year_id);
            })
            ->latest()
            ->get();

        return view('admin.fee-structure.fee-structure_list', [
            'feeStructure' => $feeStructure,
            'classes' => Classes::all(),
            'academic_years' => AcademicYear::all()
        ]);
    }

    public function delete($id) {
        $fee = FeeStructure::findOrFail($id);
        $fee->delete();
        return redirect()->back()->with('success', 'Fee Structure Deleted Successfully');
    }

    public function edit($id) {
        return view('admin.fee-structure.edit-fee-structure', [
            'fee' => FeeStructure::findOrFail($id),
            'classes' => Classes::all(),
            'academic_years' => AcademicYear::all(),
            'fee_heads' => FeeHead::all()
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'academic_year_id' => "required|exists:academic_years,id",
            'class_id' => "required|exists:classes,id",
            'fee_head_id' => "required|exists:fee_heads,id"
        ]);

        $fee = FeeStructure::findOrFail($id);
        $fee->class_id = $request->class_id;
        $fee->academic_year_id = $request->academic_year_id;
        $fee->fee_head_id = $request->fee_head_id;
        $fee->april = $request->april ?? 0;
        $fee->may = $request->may ?? 0;
        $fee->june = $request->june ?? 0;
        $fee->july = $request->july ?? 0;
        $fee->august = $request->august ?? 0;
        $fee->september = $request->september ?? 0;
        $fee->october = $request->october ?? 0;
        $fee->november = $request->november ?? 0;
        $fee->december = $request->december ?? 0;
        $fee->january = $request->january ?? 0;
        $fee->february = $request->february ?? 0;
        $fee->march = $request->march ?? 0;
        $fee->save();

        return redirect()->route('fee-structure.index')->with('success', 'Fee Structure Updated Successfully');
    }
}
