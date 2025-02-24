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

                            {{-- <div class="form-group">
                                <select name="employee_id" id="" class="js-example-basic-single" style="width:100%">
                                    @foreach ($Employee_Id as $employee)
                                        <option value="{{ $employee->id }}" 
                                            {{ (isset($selectedEmployeeId) && $selectedEmployeeId == $employee->id) ? 'selected' : '' }}>
                                            {{ $employee->employee_id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="form-group">
                                <label for="employee_id">Employee</label>
                                <select name="employee_id" class="form-control" required>
                                    @foreach($Employee_Id as $employee)
                                        <option value="{{ $employee->id }}" {{ $Attendance->employee_id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->employee_id }}
                                        </option>
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
                            <!-- Worked Hours -->
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail3">Worked Hours</label>
                                <input type="number" step="0.01" name="worked_hours" class="form-control" id="exampleInputEmail3"
                                value="{{ $Attendance->worked_hours }}" readonly>
                                @error('worked_hours')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            <!-- Overtime Hours -->
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail3">Overtime Hours</label>
                                <input type="number" step="0.01" name="overtime_hours" class="form-control" id="exampleInputEmail3"
                                value="{{ $Attendance->overtime_hours }}" readonly>
                                @error('overtime_hours')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            
                            <!-- Late Minutes -->
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail3">Late Minutes</label>
                                <input type="number" step="0.01" name="late_minutes" class="form-control" id="exampleInputEmail3"
                                value="{{ $Attendance->late_minutes }}" readonly>
                                @error('late_minutes')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            
                            <!-- Early Exit Minutes -->
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail3">Early Exit Minutes</label>
                                <input type="number" step="0.01" name="early_exit_minutes" class="form-control" id="exampleInputEmail3"
                                value="{{ $Attendance->early_exit_minutes }}" readonly>
                                @error('early_exit_minutes')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            
                            <!-- Daily Salary -->
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail3">Daily Salary</label>
                                <input type="number" step="0.01" name="daily_salary" class="form-control" id="exampleInputEmail3"
                                value="{{ $Attendance->daily_salary }}" readonly>
                                @error('daily_salary')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">eidt</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @endsection
