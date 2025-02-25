<?php

namespace App\Http\Controllers;

use App\Models\Bonuse;
use App\Models\Deduction;
use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Month;
use PDF;

class PayrollController extends Controller
{
    // INDEX: Show all payrolls
    public function index(Request $request)
    {
        $query = Payroll::query();
    
        // **Agar month_id select nahi kiya, to filtering na karein**
        if ($request->filled('month_id')) {
            $query->where('month_id', $request->month_id);
        }
    
        // **Agar employee_id select nahi kiya, to filtering na karein**
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }
    
        $payrolls = $query->with('employee')->get();
        $employees = Employee::all();
        $months = Month::all();
    
        return view('Dashboard.Payrolls.index', compact('payrolls', 'employees', 'months'));
    }
    

    // CREATE: Show create payroll form
    public function insert()
    {
        $employees = Employee::all();
        $months = Month::all();
        $deductions = Deduction::all();
        $bonuses = Bonuse::all();
        return view('Dashboard.Payrolls.insert', compact('employees', 'months','deductions','bonuses'));
    }

    // STORE: Insert new payroll record
    public function Store(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
    
        // Employee ke attendance records fetch karna
        $attendances = Attendance::where('employee_id', $request->employee_id)
            ->whereMonth('date', $request->month_id)
            ->whereYear('date', $request->year)
            ->get();
    
        // Attendance counts
        $total_present = $attendances->where('total_present', 1)->count();
        $total_absent = $attendances->where('total_absent', 1)->count();
        $total_late = $attendances->where('total_late', 1)->count();
    
        // Basic Salary
        $basic_salary = $employee->Designation->basic_salary;
        $daily_salary = $basic_salary / 26;
    
        // Late & Absent Deductions
        $late_deduction = floor($total_late / 3) * $daily_salary;
        $absent_deduction = $total_absent * $daily_salary;
    
        // **Fetch Deductions from Deduction Table**
        $other_deductions = Deduction::where('employee_id', $request->employee_id)
            ->where('month_id', $request->month_id)
            ->where('year', $request->year)
            ->sum('amount'); // Total deductions
    
        // **Fetch Bonuses from Bonuse Table**
        $bonuses = Bonuse::where('employee_id', $request->employee_id)
            ->where('month_id', $request->month_id)
            ->where('year', $request->year)
            ->sum('amount'); // Total bonuses
    
        // Total Deductions Calculation
        $total_deductions = $late_deduction + $absent_deduction + $other_deductions;
    
        // Net Salary Calculation
        $gross_salary = ($total_present * $daily_salary) - $total_deductions + $bonuses;
    
      // Check if payroll already exists, then update; otherwise, create new
      Payroll::updateOrCreate(
        [
            'employee_id' => $request->employee_id,
            'month_id' => $request->month_id,
            'year' => $request->year,
        ],
        [
            'basic_salary' => $basic_salary,
            'total_present' => $total_present,
            'total_absent' => $total_absent,
            'total_late' => $total_late,
            'deductions' => $total_deductions,
            'bonuses' => $bonuses,
            'net_salary' => $gross_salary,
            'status' => 0, // Default: Unpaid
        ]);
    
        return redirect('/Payrolls')->with('success', 'Payroll added successfully.');
    }
    


    // EDIT: Show edit form
    public function edit($id)
    {
        $payroll = Payroll::findOrFail($id);
        $employees = Employee::all();
        $months = Month::all();
        return view('Dashboard.Payrolls.edit', compact('payroll', 'employees', 'months'));
    }

    // UPDATE: Save edited payroll
    public function update(Request $request, $id)
    {
        $payroll = Payroll::findOrFail($id);
        
        // Agar employee_id, month_id, ya year change ho gaye hain, to naye employee ka data fetch karein
        if ($request->employee_id != $payroll->employee_id || $request->month_id != $payroll->month_id || $request->year != $payroll->year) {
            $employee = Employee::findOrFail($request->employee_id);
            
            $attendances = Attendance::where('employee_id', $request->employee_id)
                ->whereMonth('date', $request->month_id)
                ->whereYear('date', $request->year)
                ->get();
        } else {
            $employee = Employee::findOrFail($payroll->employee_id);
            
            $attendances = Attendance::where('employee_id', $payroll->employee_id)
                ->whereMonth('date', $payroll->month_id)
                ->whereYear('date', $payroll->year)
                ->get();
        }
    
        // Attendance counts
        $total_present = $attendances->where('total_present', 1)->count();
        $total_absent = $attendances->where('total_absent', 1)->count();
        $total_late = $attendances->where('total_late', 1)->count();
    
        // Basic Salary
        $basic_salary = $employee->Designation->basic_salary;
        $daily_salary = $basic_salary / 26;
    
        // Late & Absent Deductions
        $late_deduction = floor($total_late / 3) * $daily_salary;
        $absent_deduction = $total_absent * $daily_salary;
    
        // **Fetch Deductions from Deduction Table**
        $other_deductions = Deduction::where('employee_id', $request->employee_id)
            ->where('month_id', $request->month_id)
            ->where('year', $request->year)
            ->sum('amount');
    
        // **Fetch Bonuses from Bonus Table**
        $bonuses = Bonuse::where('employee_id', $request->employee_id)
            ->where('month_id', $request->month_id)
            ->where('year', $request->year)
            ->sum('amount');
    
        // Total Deductions Calculation
        $total_deductions = $late_deduction + $absent_deduction + $other_deductions;
    
        // Net Salary Calculation
        $gross_salary = ($total_present * $daily_salary) - $total_deductions + $bonuses;
    
        // Update Payroll Record
        $payroll->update([
            'employee_id' => $request->employee_id,
            'month_id' => $request->month_id,
            'year' => $request->year,
            'basic_salary' => $basic_salary,
            'total_present' => $total_present,
            'total_absent' => $total_absent,
            'total_late' => $total_late,
            'deductions' => $total_deductions,
            'bonuses' => $bonuses,
            'net_salary' => $gross_salary,
            'status' => $request->status, // User input for Paid/Unpaid status
        ]);
    
        return redirect('/Payrolls')->with('success', 'Payroll updated successfully.');
    }
    
    


    // DELETE: Remove payroll record
    public function delete($id)
    {
        Payroll::findOrFail($id)->delete();
        return redirect('/Payrolls')->with('success', 'Payroll deleted.');
    }
    
    
    // Salary Slip View
    public function generateSalarySlip($id)
    {
        $payroll = Payroll::with('employee')->findOrFail($id);

        // Load view and convert it to PDF
        $pdf = PDF::loadView('Dashboard.Payrolls.salary-slip', compact('payroll'));

        // Download PDF
        return $pdf->download('salary_slip_'.$payroll->employee->name.'.pdf');
    }

}