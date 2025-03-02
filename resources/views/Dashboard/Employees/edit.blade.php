@extends('layout.dashboard')
@section('mydashboard')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Employee Edit </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Edit</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Employee Edit</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Employee Edit</h4>
                       
                        <form action="{{ url('/Employeesupdate') }}/{{ $Employee->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Employee ID</label>
                                <input type="text" name="employee_id" class="form-control" value="{{ old('employee_id', $Employee->employee_id) }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $Employee->name) }}">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $Employee->email) }}">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="number" name="phone" class="form-control" value="{{ old('phone', $Employee->phone) }}">
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address', $Employee->address) }}">
                            </div>

                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="img" class="form-control">
                                <img src="{{ asset('uploads/employees/'.$Employee->img) }}" width="100" class="mt-2">

                                @if ($Employee->img != null)
                                Old Image : <img src="{{ url($Employee->img) }}" class="img-fluid rounded" width="80px"
                                    height="50px" />
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Designation</label>
                                <select id="designation" class="form-control" name="designation">
                                    @foreach ($designation_Id as $designation)
                                        <option value="{{ $designation->id }}" {{ $designation->id == $Employee->designation ? 'selected' : '' }}>{{ $designation->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department_id">
                                    @foreach ($department_Id as $department)
                                        <option value="{{ $department->id }}" {{ $department->id == $Employee->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Basic Salary</label>
                                <input type="text" id="basic_salary" class="form-control"
                                    value="{{ old('basic_salary', $Employee->basic_salary) }}" readonly>
                                <input type="hidden" id="hidden_basic_salary" name="basic_salary"
                                    value="{{ old('basic_salary', $Employee->basic_salary) }}">
                            </div>
    

                            {{-- <div class="form-group">
                                <label>Basic Salary</label>
                                <input type="text" id="basic_salary" name="basic_salary" class="form-control" value="{{ old('basic_salary', $Employee->basic_salary) }}" readonly>
                            </div> --}}

                            <div class="form-group">
                                <label>Joining Date</label>
                                <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', $Employee->joining_date) }}">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $Employee->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ $Employee->status == 2 ? 'selected' : '' }}>Unactive</option>
                                    <option value="3" {{ $Employee->status == 3 ? 'selected' : '' }}>Terminated</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="/Employees" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- JavaScript to auto-update Basic Salary on Designation Change -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#designation').change(function () {
            var designation_id = $(this).val();
            if (designation_id) {
                $.ajax({
                    url: "/getBasicSalary/" + designation_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $('#basic_salary').val(data.basic_salary);
                            $('#hidden_basic_salary').val(data.basic_salary); // Update hidden field
                        }
                    },
                    error: function () {
                        alert('Error fetching salary data');
                    }
                });
            }
        });
    });
</script>

@endsection
