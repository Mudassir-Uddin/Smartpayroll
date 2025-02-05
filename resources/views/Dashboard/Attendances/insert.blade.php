@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Attendance Insert </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inserts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Attendance Insert</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Attendance Insert</h4>
                        <p class="card-description">Attendance Insert </p>
                        <form class="forms-sample" action="{{ url('/AttendancesStore') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Select Employee_id:</label>
                                <select class="js-example-basic-single" name="employee_id" style="width:100%">
                                    <option value="" disabled>Select employee_id</option>
                                    @foreach ($employee_Id as $employee_id)
                                        <option value="{{ $employee_id->id }}">{{ $employee_id->employee_id }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Date</label>
                                <input type="date" name="date" class="form-control" id="exampleInputName1"
                                    placeholder="Date" value="{{ old('date') }}">
                                @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">

                                <label for="formFileLg" class="form-label">Status</label>
                                <select name="status" id="" class="form-select mb-3" value="{{ old('status') }}"
                                    style="width:100%">
                                    <option value="0" selected disabled>Select Status</option>
                                    <option value="1">Present</option>
                                    <option value="2">Absent</option>
                                    <option value="3">Half-Day</option>
                                    <option value="4">Leave</option>
                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Time_in</label>
                                <input type="time" name="time_in" class="form-control" id="exampleInputName1"
                                    placeholder="Time In" value="{{ old('time_in') }}">
                                @error('time_in')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Time_out</label>
                                <input type="time" name="time_out" class="form-control" id="exampleInputName1"
                                    placeholder="time_out" value="{{ old('time_out') }}">
                                @error('time_out')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-dark"><a href="/Attendances" class="btn btn-dark">Cancel</a></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @endsection
