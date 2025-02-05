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
                        <h4 class="card-title">Attendance table</h4>
                        <p class="card-description"> Add Attendance :-  <code><a href="/AttendancesInsert">Attendances-Insert</a></code>
                        </p>
                        <div class="table-responsive">
                            <table id="AttendanceTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Sn </th>
                                        <th> Employee Id </th>
                                        <th> Date </th>
                                        <th> Status </th>
                                        <th> Time IN </th>
                                        <th> Time OUT </th>
                                        <th> Date </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($Attendances as $Ep)
                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            <td>{{ $Ep->Employee->employee_id }}</td>
                                            <td>{{ $Ep->date }}</td>
                                            <td>
                                                @if ($Ep->status == 1)
                                                    <option value="1">Present</option>
                                                @elseif ($Ep->status == 2)
                                                    <option value="2">Absent</option>
                                                    {{-- @endforeach --}}
                                                @elseif ($Ep->status == 3)
                                                    <option value="3">Half-Day</option>
                                                    {{-- @endforeach --}}
                                                @else
                                                    <option value="4">Leave</option>
                                                @endif
                                            </td>
                                            <td>{{ $Ep->time_in }}</td>
                                            <td>{{ $Ep->time_out }}</td>
                                            <td>{{ $Ep->updated_at = date('Y-m-d') }}</td>
                                            <td>
                                                <button class="btn btn-warning "><a class="text-white"
                                                        href="{{ url('/Attendancesedit') }}/{{ $Ep->id * 548548 }}">Edit</a></button>
                                                <button onclick="myfun({{ $Ep->id }})"
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
