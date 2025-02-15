@extends('admin.layout')
@section('content')

<div class="content-wrapper">

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Create Student</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Create Student</li>
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
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
          <div class="card-header">
            <h3 class="card-title"> Add Student </h3>
          </div>


          <form action="{{route('student.store')}}" method="post">
            @csrf
          
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                       
                        <label>Select Academic Year</label>
                        <select name="academic_year_id" class="form-control">
                            <option value="" disabled selected>Select Academic Year </option>
                                @foreach($academic_years  as $academic_year)
                                 <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                                @endforeach               
                        </select>
                        @error('academic_year_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>     
                    <div class="form-group col-md-4">
                        <label>Admission Date</label>
                       <input type="date" name="admission_date" class="form-control">
                        @error('admission_date')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>                
                </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Student Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Student Name">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Student's Father Name</label>
                <input type="text" name="father_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Student's Father Name">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Student's Mother Name</label>
                <input type="text" name="mother_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Student's Mother Name">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Date Of Birth</label>
                <input type="date" name="dob" class="form-control" id="exampleInputEmail1" >
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Mobile Number</label>
                <input type="text" name="mobno" class="form-control" id="exampleInputEmail1" placeholder="Enter Mobile Number">
            </div>
            
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Email Address</label>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email Address">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1"> Create Password</label>
                <input type="text" name="november" class="form-control" id="exampleInputEmail1" placeholder="Enter november Fee">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">December Fee</label>
                <input type="text" name="december" class="form-control" id="exampleInputEmail1" placeholder="Enter December Fee">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">January Fee</label>
                <input type="text" name="january" class="form-control" id="exampleInputEmail1" placeholder="Enter January Fee">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">February Fee</label>
                <input type="text" name="february" class="form-control" id="exampleInputEmail1" placeholder="Enter February Fee">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">March Fee</label>
                <input type="text" name="march" class="form-control" id="exampleInputEmail1" placeholder="Enter March Fee">
            </div>
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

