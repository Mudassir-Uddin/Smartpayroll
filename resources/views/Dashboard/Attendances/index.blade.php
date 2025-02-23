@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Attendance Tables </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Attendance tables</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- Filter Form -->
                    <form method="GET" action="{{ url('/Attendances') }}" class="mb-4">
                        <label>Month:</label>
                        <select name="month">
                            <option value="">All</option>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endfor
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

                        <h4 class="card-title">Attendance table</h4>
                        <p class="card-description"> Add Attendance :-  <code><a href="/AttendancesInsert">Attendances-Insert</a></code>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="employeeTable">
                                <thead>
                                    <tr>
                                        <th>Emp Id</th>
                                        <th>Emp Name</th>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Worked Hours</th>
                                        <th>Late Minutes</th>
                                        <th>Early Exit</th>
                                        <th>Total Present</th>
                                        <th>Total Absent</th>
                                        <th>Total Late</th>
                                        <th>Daily Salary</th>
                                        <th>Total Salary</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Attendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->employee->employee_id }}</td>
                                        <td>{{ $attendance->employee->name }}</td>
                                        <td>{{ $attendance->date }}</td>
                                        <td>{{ $attendance->time_in ?? 'N/A' }}</td>
                                        <td>{{ $attendance->time_out ?? 'N/A' }}</td>
                                        <td>{{ $attendance->worked_hours }}</td>
                                        <td>{{ $attendance->late_minutes }}</td>
                                        <td>{{ $attendance->early_exit_minutes }}</td>
                                        <td>{{ $attendance->total_present }}</td>
                                        <td>{{ $attendance->total_absent }}</td>
                                        <td>{{ $attendance->total_late }}</td>
                                        <td>{{ $attendance->daily_salary }}</td>
                                        <td>{{ $attendance->total_salary }}</td>
                                        <td>
                                            @if ($attendance->time_in == null || $attendance->time_out == null)
                                                <span class="badge bg-danger">Absent</span>
                                            @elseif (\Carbon\Carbon::parse($attendance->time_in)->greaterThan(\Carbon\Carbon::createFromTime(8, 45, 0)) || 
                                                    \Carbon\Carbon::parse($attendance->time_out)->lessThan(\Carbon\Carbon::createFromTime(16, 45, 0)))
                                                <span class="badge bg-danger">Absent</span>
                                            @elseif (\Carbon\Carbon::parse($attendance->time_in)->greaterThan(\Carbon\Carbon::createFromTime(8, 0, 0)) &&
                                                    \Carbon\Carbon::parse($attendance->time_in)->lessThanOrEqualTo(\Carbon\Carbon::createFromTime(8, 45, 0)))
                                                <span class="badge bg-warning">Late</span>
                                            @elseif (\Carbon\Carbon::parse($attendance->time_in)->lessThanOrEqualTo(\Carbon\Carbon::createFromTime(8, 0, 0)) && 
                                                    \Carbon\Carbon::parse($attendance->time_out)->greaterThanOrEqualTo(\Carbon\Carbon::createFromTime(17, 0, 0)))
                                                <span class="badge bg-success">Present</span>
                                            @else
                                                <span class="badge bg-secondary">Unknown</span> <!-- Default case, just in case -->
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <a href="{{ url('/Attendancesedit') }}/{{ $attendance->id * 548548 }}" class="btn btn-primary">Edit</a>
                                            <button onclick="myfun({{ $attendance->id }})"
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
                  window.location.href = "{{ url('/Attendancesdelete') }}/" + id
              }
          })
          // if (ans) {
          //     var ans = confirm("Do you want to delete ?")

          // }
      }
  </script>

  <style>
.swal2-title {
    color: black !important;  /* Force black color */
}
</style>
    @endsection
