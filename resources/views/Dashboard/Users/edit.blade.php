@extends('layout.dashboard')
@section('mydashboard')
   <!-- partial -->
   <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Form elements </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">Form elements</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Basic form elements</h4>
            <p class="card-description"> Basic form elements </p>
  
            <form action="{{ url('/Usersupdate') }}/{{ $user->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputName1">username</label>
                                    <input type="text" class="form-control" id="exampleInputName1" value="{{ $user->name }}"
                                        name="name" placeholder="Name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                
                <div class="form-group">
                  <label>File upload</label>
                  <input type="file" name="img" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input type="file" name="img" class="form-control file-upload-info" placeholder="Upload Image">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                  </div>
                  @error('img')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                                    <br>
                  
                  @if ($user->img != null)
                  Old Image : <img src="{{ url($user->img) }}" class="img-fluid rounded"
                      width="80px" height="50px" />
              @endif
                </div>                        

                                <div class="form-group">
                                    <label for="exampleInputEmail3">email</label>
                                    <input type="text" class="form-control" id="exampleInputEmail3" value="{{ $user->email }}"
                                        name="email" placeholder="Email">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- <div class="form-floating mb-3">
                                  <input type="TEXT" class="form-control" id="floatingText" id="password" 
                                      name="password" placeholder="jhondoe">
                                  <label for="floatingText">Change password</label>
                                  @error('password')
                                      <p class="text-danger">{{ $message }}</p>
                                  @enderror
                              </div> --}}

                                {{-- {{session()->get('role')==2 ?  "Manager" : "Admin"  }} --}}
                                @if (session()->has('role') && session('role') == 1)
                                    <label for="formFileLg" class="form-label">Role</label>
                                    <select name="role" id="" class="form-select mb-3">
                                        {{-- @foreach ($Service as $sr) --}}
                                        @if ($user->role == 1)
                                            <option value="1">---Admin---</option>
                                        @elseif ($user->role == 3)
                                            <option value="3">---Manager---</option>
                                        @else
                                            <option value="2">---User---</option>
                                        @endif

                                        <option value="1">Admin</option>
                                        <option value="3">Manager</option>
                                        <option value="2">User</option>


                                        {{-- @endforeach --}}
                                    </select>


                                    <label for="formFileLg" class="form-label">Status</label>
                                    <select name="status" id="" class="form-select mb-3">
                                        @if ($user->status == 1)
                                            {{-- @foreach ($Service as $sr) --}}
                                            <option value="1">---Active---</option>
                                        @else
                                            <option value="2">---Unactive---</option>
                                            {{-- @endforeach --}}
                                        @endif
                                        <option value="1">Active</option>
                                        <option value="2">Unactive</option>
                                    </select>
                                @else
                                @endif
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">eidt</button>
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
              <!-- content-wrapper ends -->
          @endsection
