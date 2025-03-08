<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function Admindashboard()
    {
        $totalEmployees = Employee::count(); // Total Employees Count

        $today = now()->toDateString(); // Aaj ki date

        // Total Present Count
        $totalPresent = Attendance::whereDate('created_at', $today)->where('total_present', '1')->count();

        // Total Absent Count (Assuming employees with no attendance entry are absent)
        $totalAbsent = Employee::count() - $totalPresent;

        // Total Late Count
        $totalLate = Attendance::whereDate('created_at', $today)->where('total_late', '1')->count();


    // Calculating Percentages
    $presentPercentage = ($totalEmployees > 0) ? round(($totalPresent / $totalEmployees) * 100, 2) : 0;
    $absentPercentage = ($totalEmployees > 0) ? round(($totalAbsent / $totalEmployees) * 100, 2) : 0;
    $latePercentage = ($totalEmployees > 0) ? round(($totalLate / $totalEmployees) * 100, 2) : 0;

    // Current Month and Year
    $currentMonth = now()->month;
    $currentYear = now()->year;

    // Salary Calculation for Current Month
    $totalSalary = Attendance::whereMonth('created_at', $currentMonth)
                          ->whereYear('created_at', $currentYear)
                          ->sum('total_salary');

// Each Employee's Salary for Current Month
$employeeSalaries = Attendance::whereMonth('created_at', $currentMonth)
->whereYear('created_at', $currentYear)
->select('employee_id', \DB::raw('SUM(total_salary) as total_salary'))
->groupBy('employee_id')
->with('employee') // Assuming Payroll has relation with Employee
->get();

        return view('Dashboard.index', compact('totalPresent', 'totalAbsent', 'totalLate' ,'presentPercentage','absentPercentage','latePercentage','totalEmployees','totalSalary','employeeSalaries'));
    }
}
