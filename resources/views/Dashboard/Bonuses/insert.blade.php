@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Bonuse Insert </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inserts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bonuse Insert</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Bonuse Insert</h4>
                        <p class="card-description">Bonuse Insert </p>
                        <form class="forms-sample" action="{{ url('/BonusesStore') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Select Employee_id:</label>
                                <select class="js-example-basic-single" name="employee_id" style="width:100%">
                                  <option value="" disabled>Select employee_id</option>
                                  @foreach ($employee_Id as $employee_id)
                                        <option value="{{ $employee_id->id }}">{{ $employee_id->employee_id }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Select Transaction_Types:</label>
                                <select class="js-example-basic-single" name="transaction_types_id" style="width:100%">
                                  <option value="" disabled>Select transaction_types_id</option>
                                  @foreach ($transaction_types_Id as $transaction_types_id)
                                        <option value="{{ $transaction_types_id->id }}">{{ $transaction_types_id->type }}</option>
                                    @endforeach
                                </select>
                                @error('transaction_types_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                              </div>

            <!-- Month Selection -->
            <div class="form-group">
                <label class="form-label">Month</label>
                <select name="month_id" class="form-control" required>
                    @foreach($months as $month)
                        <option value="{{ $month->id }}">{{ $month->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Year Selection -->
            <div class="form-group">
                <label class="form-label">Year</label>
                <input type="number" name="year" class="form-control" value="{{ date('Y') }}" required>
            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Amount</label>
                                <input type="number" name="amount" class="form-control" id="exampleInputName1"
                                    placeholder="Amount" value="{{ old('amount') }}" min="0">
                                @error('amount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">remarks</label>
                                <input type="text" name="remarks" class="form-control" id="exampleInputName1"
                                    placeholder="remarks" value="{{ old('remarks') }}">
                                @error('remarks')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-dark"><a href="/Bonuses" class="btn btn-dark">Cancel</a></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @endsection
