@extends('layout.dashboard')
@section('mydashboard')

  <!-- partial -->
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Month Insert </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inserts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Month Insert</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Month Insert</h4>
              <p class="card-description">Month Insert </p>
              <form class="forms-sample" action="{{url('/MonthsStore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputName1">Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name" value="{{old('name')}}">
                  @error('name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-dark"><a href="/Months" class="btn btn-dark">Cancel</a></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->

@endsection