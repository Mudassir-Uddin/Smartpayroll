@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Deduction Edit </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Edits</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Deduction Edit </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Deduction Edit </h4>
                        <p class="card-description"> Deduction Edit </p>

                        <form action="{{ url('/Deductionsupdate') }}/{{ $Deduction->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <select name="employee_id" id="" class="js-example-basic-single" style="width:100%">
                                    @foreach ($employee_Id as $Employee_id)
                                        {{-- <option value="0">Select SubServices</option> --}}
                                        @if ($Employee_id->id == $Employee_id->brand_id)
                                            <option value="{{ $Employee_id->id }}" selected>{{ $Employee_id->employee_id }}
                                            </option>
                                        @else
                                            <option value="{{ $Employee_id->id }}">{{ $Employee_id->employee_id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="transaction_types_id" id="" class="js-example-basic-single" style="width:100%">
                                    @foreach ($transaction_types_Id as $transaction_types_id)
                                        {{-- <option value="0">Select SubServices</option> --}}
                                        @if ($transaction_types_id->id == $transaction_types_id->brand_id)
                                            <option value="{{ $transaction_types_id->id }}" selected>{{ $transaction_types_id->type }}
                                            </option>
                                        @else
                                            <option value="{{ $transaction_types_id->id }}">{{ $transaction_types_id->type }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputName1">Amount</label>
                                <input type="number" class="form-control" id="exampleInputName1"
                                    value="{{ $Deduction->amount }}" name="amount" placeholder="Amount" min="0">
                                @error('amount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Date</label>
                                <input type="date" class="form-control" id="exampleInputName1"
                                    value="{{ $Deduction->date }}" name="date" placeholder="Date">
                                @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Remarks</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    value="{{ $Deduction->remarks }}" name="remarks" placeholder="remarks">
                                @error('remarks')
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
