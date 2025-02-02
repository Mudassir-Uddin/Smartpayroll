@extends('layout.dashboard')
@section('mydashboard')

  <!-- partial -->
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Department Form </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Department Form</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Department Form</h4>
              <p class="card-description">Department Form </p>
              <form class="forms-sample" action="{{url('/DepartmentsStore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputName1">Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name" value="{{old('name')}}">
                  @error('name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail3">Description</label>
                  <input type="text" name="description" class="form-control" id="exampleInputEmail3" placeholder="Description" value="{{old('Description')}}">
                  @error('Description')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-dark"><a href="/Departments" class="btn btn-dark">Cancel</a></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->

@endsection