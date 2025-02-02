@extends('layout.dashboard')
@section('mydashboard')
   <!-- partial -->
   <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Department Form  </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page"> Department Form </li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Department form </h4>
            <p class="card-description"> Department form  </p>
  
            <form action="{{ url('/Departmentsupdate') }}/{{ $department->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputName1">Department Name</label>
                                    <input type="text" class="form-control" id="exampleInputName1" value="{{ $department->name }}"
                                        name="name" placeholder="Department Name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail3">Description</label>
                                    <input type="text" class="form-control" id="exampleInputEmail3" value="{{ $department->description }}"
                                        name="description" placeholder="Description">
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">eidt</button>
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
              <!-- content-wrapper ends -->
          @endsection
