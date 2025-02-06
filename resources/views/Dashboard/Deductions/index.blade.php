@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Deduction Tables </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Deduction tables</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Deduction table</h4>
                        <p class="card-description"> Add Deduction :-  <code><a href="/DeductionsInsert">Deductions-Insert</a></code>
                        </p>
                        <div class="table-responsive">
                            <table id="employeeTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Sn </th>
                                        <th> Employee Id </th>
                                        <th> Deductions </th>
                                        <th> Amount </th>
                                        <th> Date </th>
                                        <th> Remarks </th>
                                        <th> Date </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($Deduction as $Bs)
                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            <td>{{ $Bs->Employee->employee_id }}</td>
                                            <td>{{ $Bs->TransactionType->type }}</td>
                                            <td>{{ $Bs->amount }}</td>
                                            <td>{{ $Bs->date }}</td>
                                            <td>{{ $Bs->remarks }}</td>
                                           
                                            <td>{{ $Bs->updated_at = date('Y-m-d') }}</td>
                                            <td>
                                                <button class="btn btn-warning "><a class="text-white"
                                                        href="{{ url('/Deductionsedit') }}/{{ $Bs->id * 548548 }}">Edit</a></button>
                                                <button onclick="myfun({{ $Bs->id }})"
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
                  window.location.href = "{{ url('/Deductionsdelete') }}/" + id
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
