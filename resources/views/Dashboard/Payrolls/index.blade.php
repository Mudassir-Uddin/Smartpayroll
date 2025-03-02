@extends('layout.Dashboard')

@section('mydashboard')
    <div class="content-wrapper">


        <div class="page-header">
            <h3 class="page-title"> Payroll Tables </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payroll tables</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">

                    <div class="card-body">
                    
                    <!-- Filter Form -->
                    <form method="GET" action="{{ url('/Payrolls') }}" class="mb-4">
                        <label>Month:</label>
                        <select name="month_id">
                            <option value="">All</option>
                            @foreach ($months as $month)
                                <option value="{{ $month->id }}"
                                    {{ request('month_id') == $month->id ? 'selected' : '' }}>
                                    {{ $month->name }}
                                </option>
                            @endforeach
                        </select>

                        <label>Employee:</label>
                        <select name="employee_id">
                            <option value="">All</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                        {{-- <h4 class="card-title">Payroll table</h4> --}}
                        <p class="card-description"> Add Payroll :- <code><a
                                    href="/PayrollsInsert">Payrolls-Insert</a></code>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="employeeTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Basic Salary</th>
                                        <th>Current Salary</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                        <th>Late</th>
                                        <th>Deductions</th>
                                        <th>Bonuses</th>
                                        <th>Net Salary</th>
                                        <th>Salary Slip</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payrolls as $payroll)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payroll->employee->name }}</td>
                                            <td>{{ $payroll->month->name }}</td>
                                            <td>{{ $payroll->year }}</td>
                                            <td>{{ number_format($payroll->basic_salary, 2) }}</td>
                                            <td>{{ number_format($payroll->basic_salary/26 * $payroll->total_present , 2) }}</td>
                                            <td>{{ $payroll->total_present }}</td>
                                            <td>{{ $payroll->total_absent }}</td>
                                            <td>{{ $payroll->total_late }}</td>
                                            <td>{{ number_format($payroll->deductions, 2) }}</td>
                                            <td>{{ number_format($payroll->bonuses,2) }}</td>
                                            <td>{{ number_format($payroll->net_salary, 2) }}</td>
                                            <td>
                                                <a href="{{ url('/payrolls/salary-slip', $payroll->id) }}" class="btn btn-sm btn-primary">Salary Slip</a>
                                            </td>
                                            
                                            <td>
                                                @if ($payroll->status == 1)
                                                    <span class="badge bg-success">Paid</span>
                                                @else
                                                    <span class="badge bg-warning">Unpaid</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('/Payrollsedit', $payroll->id) }}"
                                                    class="btn btn-sm btn-info">Edit</a>
                                                <button onclick="myfun({{ $payroll->id }})"
                                                    class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function myfun(id) {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'

                        )
                        window.location.href = "{{ url('/Payrollsdelete') }}/" + id
                    }
                })
                // if (ans) {
                //     var ans = confirm("Do you want to delete ?")

                // }
            }
        </script>

        <style>
            .swal2-title {
                color: black !important;
                /* Force black color */
            }
        </style>
    @endsection
