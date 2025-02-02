@extends('layout.dashboard')
@section('mydashboard')

  <!-- partial -->
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> User Form </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Form</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> User Form</h4>
              <p class="card-description">User Form </p>
              <form class="forms-sample" action="{{url('/UsersStore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputName1">Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name" value="{{old('name')}}">
                  @error('name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail3">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="{{old('email')}}">
                  @error('email')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Password</label>
                  <input type="password" name="pass" class="form-control" id="exampleInputPassword4" placeholder="Password" value="{{old('pass')}}">
                  @error('pass')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                {{-- <div class="form-group">
                  <label for="exampleSelectGender">Gender</label>
                  <select class="form-control" id="exampleSelectGender">
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div> --}}
                {{-- <div class="form-group">
                  <label>File upload</label>
                  <input type="file" name="img[]" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                  </div>
                </div> --}}
                {{-- <div class="form-group">
                  <label for="exampleInputCity1">City</label>
                  <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                </div>
                <div class="form-group">
                  <label for="exampleTextarea1">Textarea</label>
                  <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                </div> --}}
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-dark"><a href="/DbUsers" class="btn btn-dark">Cancel</a></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->

@endsection