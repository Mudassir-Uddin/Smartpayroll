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

                        <form action="{{url('/Payrollsupdate')}}/{{ $payroll->id }}" method="POST">
                            @csrf
                        
                            <div class="form-group">
                                <label for="employee_id">Employee</label>
                                <select name="employee_id" class="form-control" required>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $payroll->employee_id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="month_id">month</label>
                                <select name="month_id" class="form-control" required>
                                    @foreach($months as $month)
                                        <option value="{{ $month->id }}" {{ $payroll->month_id == $month->id ? 'selected' : '' }}>
                                            {{ $month->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" name="year" class="form-control" value="{{ $payroll->year }}" required min="2000">
                            </div>
                        
                            <div class="form-group">
                                <label for="gross_salary">Gross Salary</label>
                                <input type="text" name="gross_salary" class="form-control" value="{{ $payroll->gross_salary }}" readonly>
                            </div>
                        
                            <div class="form-group">
                                <label for="total_present">Total Present</label>
                                <input type="number" name="total_present" class="form-control" value="{{ $payroll->total_present }}" readonly>
                            </div>
                        
                            <div class="form-group">
                                <label for="total_late">Total Late</label>
                                <input type="number" name="total_late" class="form-control" value="{{ $payroll->total_late }}" readonly>
                            </div>
                        
                            <div class="form-group">
                                <label for="total_absent">Total Absent</label>
                                <input type="number" name="total_absent" class="form-control" value="{{ $payroll->total_absent }}" readonly>
                            </div>
                        
                            <div class="form-group">
                                <label for="net_salary">Net Salary</label>
                                <input type="text" name="net_salary" class="form-control" value="{{ $payroll->net_salary }}" readonly>
                            </div>
                        
                            <div class="form-group">
                                <label for="formFileLg" class="form-label">Status</label>
                                <select name="status" id="" class="form-select mb-3" style="width:100%">
                                    {{-- @foreach ($Service as $sr) --}}
                                    @if ($payroll->status == 0)
                                        <option value="0">---Unpaid---</option>
                                    @else
                                        <option value="1">---Paid---</option>
                                    @endif
    
                                    <option value="0">Unpaid</option>
                                    <option value="1">Paid</option>
    
    
                                    {{-- @endforeach --}}
                                </select>
                                </div>

                            <button type="submit" class="btn btn-primary">Update Payroll</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @endsection
