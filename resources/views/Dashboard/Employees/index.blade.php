@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Employee Tables </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Employee tables</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employee table</h4>
                        <p class="card-description"> Add Employee :-  <code><a href="/EmployeesInsert">Employees-Insert</a></code>
                        </p>
                        <div class="table-responsive">
                            <table id="employeeTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Sn </th>
                                        <th> Employee Id </th>
                                        <th> Name </th>
                                        <th> Image </th>
                                        <th> Email </th>
                                        <th> Phone </th>
                                        <th> Address </th>
                                        <th> Designation </th>
                                        <th> Department </th>
                                        <th> Basic Salary </th>
                                        <th> Joining Date </th>
                                        <th> Status </th>
                                        <th> Date </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($Employee as $Ep)
                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            <td>{{ $Ep->employee_id }}</td>
                                            <td>{{ $Ep->name }}</td>
                                            <td><img src="{{$Ep->img}}" alt=""></td>
                                            <td>{{ $Ep->email }}</td>
                                            <td>{{ $Ep->phone }}</td>
                                            <td>{{ $Ep->address }}</td>
                                            <td>{{ $Ep->Designation->name }}</td>
                                            <td>{{ $Ep->Department->name }}</td>
                                            <td>{{ $Ep->Designation->basic_salary }}</td>
                                            <td>{{ $Ep->joining_date }}</td>
                                            <td>
                                                @if ($Ep->status == 1)
                                                    <option value="1">Active</option>
                                                @elseif ($Ep->status == 2)
                                                    <option value="2">Unactive</option>
                                                    {{-- @endforeach --}}
                                                @else
                                                    <option value="3">Terminated</option>
                                                @endif
                                            </td>
                                            <td>{{ $Ep->updated_at = date('Y-m-d') }}</td>
                                            <td>
                                                <button class="btn btn-warning "><a class="text-white"
                                                        href="{{ url('/Employeesedit') }}/{{ $Ep->id * 548548 }}">Edit</a></button>
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
                  window.location.href = "{{ url('/Employeesdelete') }}/" + id
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
