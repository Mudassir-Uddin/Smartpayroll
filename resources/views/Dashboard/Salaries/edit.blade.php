@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Salary Edit </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Edits</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Salary Edit </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Salary Edit </h4>
                        <p class="card-description"> Salary Edit </p>

                        <form action="{{ url('/Salariesupdate') }}/{{ $Salary->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <select name="employee_id" id="" class="js-example-basic-single" style="width:100%">
                                    @foreach ($Employee_Id as $employee_id)
                                        {{-- <option value="0">Select SubServices</option> --}}
                                        @if ($employee_id->id == $employee_id->brand_id)
                                            <option value="{{ $employee_id->id }}" selected>{{ $employee_id->employee_id }}
                                            </option>
                                        @else
                                            <option value="{{ $employee_id->id }}">{{ $employee_id->employee_id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Date</label>
                                <input type="date" class="form-control" id="exampleInputName1"
                                    value="{{ $Salary->date }}" name="date" placeholder="Date">
                                @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Amount</label>
                                <input type="number" class="form-control" id="exampleInputEmail3"
                                    value="{{ $Salary->amount }}" name="amount" placeholder="amount">
                                @error('amount')
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
