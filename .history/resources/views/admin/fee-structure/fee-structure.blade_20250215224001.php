@extends('admin.layout')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Fee Structure</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Academic Year</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-primary">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card-header">
                            <h3 class="card-title">Add Fee Structure</h3>
                        </div>

                        <form action="{{ route('fee-structure.store') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Select Academic Year</label>
                                        <select name="academic_year_id" class="form-control">
                                            <option value="" disabled selected>Select Academic Year</option>
                                            @foreach($academic_years as $academic_year)
                                                <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('academic_year_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Select Fee Head</label>
                                        <select name="fee_head_id" class="form-control">
                                            <option value="" disabled selected>Select Fee Head</option>
                                            @foreach($fee_heads as $fee_head)
                                                <option value="{{ $fee_head->id }}">{{ $fee_head->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('fee_head_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Select Class</label>
                                        <select name="class_id" class="form-control">
                                            <option value="" disabled selected>Select Class</option>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    @php
                                        $months = ['april', 'may', 'june', 'july', 'august', 'september', 
                                                   'october', 'november', 'december', 'january', 'february', 'march'];
                                    @endphp
                                    @foreach($months as $month)
                                        <div class="form-group col-md-4">
                                            <label for="{{ $month }}">{{ ucfirst($month) }} Fee</label>
                                            <input type="number" name="{{ $month }}" class="form-control" id="{{ $month }}" 
                                                   placeholder="Enter {{ ucfirst($month) }} Fee" value="{{ old($month) }}">
                                            @error($month)
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Fee Structure</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
@endsection
