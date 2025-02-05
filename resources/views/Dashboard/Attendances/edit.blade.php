@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Attendance Edit </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Edits</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Attendance Edit </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Attendance Edit </h4>
                        <p class="card-description"> Attendance Edit </p>

                        <form action="{{ url('/Attendancesupdate') }}/{{ $Attendance->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <select name="employee_id" id="" class="js-example-basic-single" style="width:100%">
                                    @foreach ($Employee_Id as $employee_id)
                                        {{-- <option value="0">Select SubServices</option> --}}
                                        @if ($employee_id->id == $employee_id->brand_id)
                                            <option value="{{ $employee_id->id }}" selected>{{ $employee_id->employee_id }}
                                            </option>
                                        @else
                                            <option value="{{ $employee_id->id }}">{{ $employee_id->employee_id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Date</label>
                                <input type="date" class="form-control" id="exampleInputName1"
                                    value="{{ $Attendance->date }}" name="date" placeholder="Date">
                                @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="formFileLg" class="form-label">Status</label>
                                <select name="status" id="" class="form-select mb-3" style="width:100%">
                                    {{-- @foreach ($Service as $sr) --}}
                                    @if ($Attendance->status == 1)
                                        <option value="1">---Present---</option>
                                    @elseif ($Attendance->status == 2)
                                        <option value="2">---Absent---</option>
                                    @elseif ($Attendance->status == 3)
                                        <option value="3">---Half-Day---</option>
                                    @else
                                        <option value="4">---Leave---</option>
                                    @endif
    
                                    <option value="1">Present</option>
                                    <option value="2">Absent</option>
                                    <option value="3">Half-Day</option>
                                    <option value="4">Leave</option>
    
    
                                    {{-- @endforeach --}}
                                </select>
                                </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Time_in</label>
                                <input type="time" class="form-control" id="exampleInputEmail3"
                                    value="{{ $Attendance->time_in }}" name="time_in" placeholder="Time_in">
                                @error('time_in')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Time_out</label>
                                <input type="time" class="form-control" id="exampleInputEmail3"
                                    value="{{ $Attendance->time_out }}" name="time_out" placeholder="Time_out">
                                @error('time_out')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">eidt</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @endsection
