@extends('layout.dashboard')
@section('mydashboard')
   <!-- partial -->
   <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Month Edit  </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Edits</a></li>
          <li class="breadcrumb-item active" aria-current="page"> Month Edit </li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Month Edit </h4>
            <p class="card-description"> Month Edit  </p>
  
            <form action="{{ url('/Monthsupdate') }}/{{ $Month->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputName1">Month Name</label>
                                    <input type="text" class="form-control" id="exampleInputName1" value="{{ $Month->name }}"
                                        name="name" placeholder="Month Name">
                                    @error('name')
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
