@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Employee Edit </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Edits</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Employee Edit </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employee Edit </h4>
                        <p class="card-description"> Employee Edit </p>

                        <form action="{{ url('/Employeesupdate') }}/{{ $Employee->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputName1">Employee Id</label>
                                <input type="number" class="form-control" id="exampleInputName1"
                                    value="{{ $Employee->employee_id }}" name="employee_id" placeholder="Employee Id">
                                @error('employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Employee Name</label>
                                <input type="text" class="form-control" id="exampleInputName1"
                                    value="{{ $Employee->name }}" name="name" placeholder="Employee Name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>File upload</label>
                                <input type="file" name="img" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="file" name="img" class="form-control file-upload-info"
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                @error('img')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <br>

                                @if ($Employee->img != null)
                                    Old Image : <img src="{{ url($Employee->img) }}" class="img-fluid rounded" width="80px"
                                        height="50px" />
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Email</label>
                                <input type="email" class="form-control" id="exampleInputName1"
                                    value="{{ $Employee->email }}" name="email" placeholder="Email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Phone</label>
                                <input type="phone" class="form-control" id="exampleInputEmail3"
                                    value="{{ $Employee->phone }}" name="phone" placeholder="Phone">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Address</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    value="{{ $Employee->address }}" name="address" placeholder="Address">
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Designation</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    value="{{ $Employee->designation }}" name="designation" placeholder="Designation">
                                @error('designation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <select name="department_id" id="" class="js-example-basic-single" style="width:100%">
                                    @foreach ($department_Id as $department_id)
                                        {{-- <option value="0">Select SubServices</option> --}}
                                        @if ($department_id->id == $department_id->brand_id)
                                            <option value="{{ $department_id->id }}" selected>{{ $department_id->name }}
                                            </option>
                                        @else
                                            <option value="{{ $department_id->id }}">{{ $department_id->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Basic Salary</label>
                                <input type="number" class="form-control" id="exampleInputEmail3"
                                    value="{{ $Employee->basic_salary }}" name="basic_salary"
                                    placeholder="Basic Salary">
                                @error('basic_salary')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Joining Date</label>
                                <input type="date" class="form-control" id="exampleInputEmail3"
                                    value="{{ $Employee->joining_date }}" name="joining_date"
                                    placeholder="Joining Date">
                                @error('joining_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                            <label for="formFileLg" class="form-label">Status</label>
                            <select name="status" id="" class="form-select mb-3" style="width:100%">
                                {{-- @foreach ($Service as $sr) --}}
                                @if ($Employee->status == 1)
                                    <option value="1">---Active---</option>
                                @elseif ($Employee->status == 2)
                                    <option value="2">---Unactive---</option>
                                @else
                                    <option value="3">---Terminated---</option>
                                @endif

                                <option value="1">Active</option>
                                <option value="2">Unactive</option>
                                <option value="3">Terminated</option>


                                {{-- @endforeach --}}
                            </select>

                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">eidt</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @endsection
