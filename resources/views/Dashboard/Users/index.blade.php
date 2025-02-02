@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> User Tables </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User tables</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User table</h4>
                        <p class="card-description"> Add User :-  <code><a href="/UsersInsert">Users-Insert</a></code>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Sn </th>
                                        <th> Name </th>
                                        <th> Image </th>
                                        <th> Email </th>
                                        <th> Role </th>
                                        <th> Status </th>
                                        <th> Date </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($Users as $ct)
                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            <td>{{ $ct->name }}</td>

                                            <td><a href="{{ $ct->img }}" data-lightbox="roadtrip" class="data"><img
                                                        src="{{ $ct->img }}" width="80px" height="50px"
                                                        class="circle" alt=""></a></td>

                                            <td>{{ $ct->email }}</td>
                                            <td>{{ $ct->role == 2 ? 'user' : ($ct->role == 1 ? 'Admin' : 'Manager') }}</td>
                                            <td>{{ $ct->status == 1 ? 'Active' : 'Unactive' }}</td>
                                            <td>{{ $ct->updated_at = date('Y-m-d') }}</td>
                                            {{-- @if (session()->get('role') == 3) --}}

                                            {{-- @elseif (session()->get('role') == 1) --}}
                                            <td>
                                                <button class="btn btn-warning "><a class="text-white"
                                                        href="{{ url('/Usersedit') }}/{{ $ct->id * 548548 }}">Edit</a></button>
                                                <button onclick="myfun({{ $ct->id }})"
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
                  window.location.href = "{{ url('/Usersdelete') }}/" + id
              }
          })
          // if (ans) {
          //     var ans = confirm("Do you want to delete ?")

          // }
      }
  </script>
  <style>
  .swal-title {
      color: red !important; /* Change title color */
      font-size: 24px; /* Adjust font size */
      font-weight: bold; /* Make it bold */
  }
</style>
    @endsection
