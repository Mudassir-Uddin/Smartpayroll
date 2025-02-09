@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Salary Insert </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inserts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Salary Insert</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Salary Insert</h4>
                        <p class="card-description">Salary Insert </p>
                        <form class="forms-sample" action="{{ url('/SalariesStore') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Select Employee_id:</label>
                                <select class="js-example-basic-single" name="employee_id" style="width:100%">
                                    <option value="" disabled selected>Select employee_id</option>
                                    @foreach ($employee_Id as $employee_id)
                                        <option value="{{ $employee_id->id }}">{{ $employee_id->employee_id }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Date</label>
                                <input type="date" name="date" class="form-control" id="exampleInputName1"
                                    placeholder="Date" value="{{ old('date') }}">
                                @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Amount</label>
                                <input type="number" name="amount" class="form-control" id="exampleInputName1"
                                    placeholder="amount" value="{{ old('amount') }}">
                                @error('amount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-dark"><a href="/Salaries" class="btn btn-dark">Cancel</a></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @endsection
