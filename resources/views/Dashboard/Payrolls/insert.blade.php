@extends('layout.dashboard')
@section('mydashboard')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Payroll Insert </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inserts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payroll Insert</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Payroll Insert</h4>
                        <p class="card-description">Payroll Insert </p>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form class="forms-sample" action="{{url('/PayrollsStore')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                    <!-- Employee Selection -->
            <div class="mb-3">
                <label class="form-label">Employee</label>
                <select name="employee_id" id="employee_id" class="form-control" required>
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" data-salary="{{ $employee->basic_salary }}">
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Month Selection -->
            <div class="mb-3">
                <label class="form-label">Month</label>
                <select name="month_id" class="form-control" required>
                    @foreach($months as $month)
                        <option value="{{ $month->id }}">{{ $month->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Year Selection -->
            <div class="mb-3">
                <label class="form-label">Year</label>
                <input type="number" name="year" class="form-control" value="{{ date('Y') }}" required>
            </div>

            <!-- Basic Salary (Auto-filled) -->
            <div class="mb-3">
                <label class="form-label">Basic Salary</label>
                <input type="number" name="basic_salary" id="basic_salary" class="form-control" readonly required>
            </div>

            <!-- Deductions Selection -->
            <div class="mb-3">
                <label class="form-label">Deductions</label>
                <select name="deductions" class="form-control" required>
                    @foreach($deductions as $deduction)
                        <option value="{{ $deduction->id }}">{{ $deduction->TransactionType->type }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Bonus Selection -->
            <div class="mb-3">
                <label class="form-label">bonus</label>
                <select name="bonuses" class="form-control" required>
                    @foreach($bonuses as $bonus)
                        <option value="{{ $bonus->id }}">{{ $bonus->TransactionType->type }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Net Salary (Auto-Calculated) -->
            <div class="mb-3">
                <label class="form-label">Net Salary</label>
                <input type="number" name="net_salary" id="net_salary" class="form-control" readonly required>
            </div>

            <!-- Payment Status -->
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="0">Unpaid</option>
                    <option value="1">Paid</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Save Payroll</button>
        </form>
    </div>

    <!-- Salary Calculation Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let employeeSelect = document.getElementById("employee_id");
            let basicSalaryInput = document.getElementById("basic_salary");
            let deductionsInput = document.getElementById("deductions");
            let bonusesInput = document.getElementById("bonuses");
            let netSalaryInput = document.getElementById("net_salary");

            function calculateSalary() {
                let basicSalary = parseFloat(basicSalaryInput.value) || 0;
                let deductions = parseFloat(deductionsInput.value) || 0;
                let bonuses = parseFloat(bonusesInput.value) || 0;
                netSalaryInput.value = (basicSalary - deductions + bonuses).toFixed(2);
            }

            employeeSelect.addEventListener("change", function() {
                let selectedOption = employeeSelect.options[employeeSelect.selectedIndex];
                let salary = selectedOption.getAttribute("data-salary");
                basicSalaryInput.value = salary ? salary : 0;
                calculateSalary();
            });

            deductionsInput.addEventListener("input", calculateSalary);
            bonusesInput.addEventListener("input", calculateSalary);
        });
    </script>
@endsection