@extends('layout.dashboard')
@section('mydashboard')

  <!-- partial -->
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Transactiontype Insert </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inserts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transactiontype Insert</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Transactiontype Insert</h4>
              <p class="card-description">Transactiontype Insert </p>
              <form class="forms-sample" action="{{url('/TransactiontypesStore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputName1">Category</label>
                  <input type="text" name="category" class="form-control" id="exampleInputName1" placeholder="Category" value="{{old('category')}}">
                  @error('category')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail3">Type</label>
                  <input type="text" name="type" class="form-control" id="exampleInputEmail3" placeholder="Type" value="{{old('type')}}">
                  @error('type')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-dark"><a href="/Transactiontypes" class="btn btn-dark">Cancel</a></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->

@endsection