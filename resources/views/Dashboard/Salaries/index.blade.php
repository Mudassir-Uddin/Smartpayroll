@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Salary Tables </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Salary tables</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Salary table</h4>
                        <p class="card-description"> Add Salary :-  <code><a href="/SalariesInsert">Salaries-Insert</a></code>
                        </p>
                        <div class="table-responsive">
                            <table id="employeeTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Sn </th>
                                        <th> Employee Id </th>
                                        <th> Date </th>
                                        <th> Amount </th>
                                        <th> Date </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($Salary as $Sy)
                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            <td>{{ $Sy->Employee->employee_id }}</td>
                                            <td>{{ $Sy->date }}</td>
                                            <td>{{ $Sy->amount }}</td>
                                            <td>{{ $Sy->updated_at = date('Y-m-d') }}</td>
                                            <td>
                                                <button class="btn btn-warning "><a class="text-white"
                                                        href="{{ url('/Salariesedit') }}/{{ $Sy->id * 548548 }}">Edit</a></button>
                                                <button onclick="myfun({{ $Sy->id }})"
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
                  window.location.href = "{{ url('/Salariesdelete') }}/" + id
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
