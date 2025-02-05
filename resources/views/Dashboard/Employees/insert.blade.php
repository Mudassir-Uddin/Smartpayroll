@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Employee Insert </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inserts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Employee Insert</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Employee Insert</h4>
                        <p class="card-description">Employee Insert </p>
                        <form class="forms-sample" action="{{ url('/EmployeesStore') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1">Employee Id</label>
                                <input type="text" name="employee_id" class="form-control" id="exampleInputName1"
                                    placeholder="Employee Id" value="{{ old('employee_id') }}">
                                @error('employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName1"
                                    placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                              <label for="img" class="form-label">Upload Image:</label>
                              <input type="file" id="img" name="img" value="{{ old('img') }}" class="form-control">
                              
                          @error('img')
                                  <p class="text-danger">{{ $message }}</p>
                          @enderror
                          </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputName1"
                                    placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Phone</label>
                                <input type="number" name="phone" class="form-control" id="exampleInputName1"
                                    placeholder="Phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Address</label>
                                <input type="text" name="address" class="form-control" id="exampleInputName1"
                                    placeholder="Address" value="{{ old('address') }}">
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Select designation_id:</label>
                                <select class="js-example-basic-single" name="designation" style="width:100%">
                                  <option value="" disabled>Select designation_id</option>
                                  @foreach ($designation_Id as $designation_id)
                                        <option value="{{ $designation_id->id }}">{{ $designation_id->name }}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Select department_id:</label>
                                <select class="js-example-basic-single" name="department_id" style="width:100%">
                                  <option value="" disabled>Select department_id</option>
                                  @foreach ($department_Id as $department_id)
                                        <option value="{{ $department_id->id }}">{{ $department_id->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                              </div>

                            {{-- <div class="form-group ">
                                <label for="exampleInputName1">Select department_id:</label>
                                <select id="exampleInputName1" name="department_id" class="form-control">
                                    <option value="">Select department_id</option>
                                    @foreach ($department_Id as $department_id)
                                        <option value="{{ $department_id->id }}">{{ $department_id->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}


                            <div class="form-group">
                                <label for="exampleInputEmail3">Basic Salary</label>
                                <input type="number" name="basic_salary" class="form-control" id="exampleInputEmail3"
                                    placeholder="Basic Salary" value="{{ old('basic_salary') }}">
                                @error('basic_salary')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                              <label for="exampleInputEmail3">Joining Date</label>
                              <input type="date" name="joining_date" class="form-control" id="exampleInputEmail3"
                                  placeholder="Joining Date" value="{{ old('joining_date') }}">
                              @error('joining_date')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                          
                          
                          <div class="form-group">
                                    
                            <label for="formFileLg" class="form-label">Status</label>
                            <select name="status" id="" class="form-select mb-3" value="{{ old('status') }}" style="width:100%">
                                <option value="0" selected disabled>Select Status</option>
                                <option value="1">Active</option>
                                <option value="2">Unactive</option>
                                <option value="3">terminated</option>
                            </select>
                            @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-dark"><a href="/Employees" class="btn btn-dark">Cancel</a></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @endsection
