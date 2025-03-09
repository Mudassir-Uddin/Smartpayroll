<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        return view('Dashboard.index', compact('totalPresent', 'totalAbsent', 'totalLate', 'presentPercentage', 'absentPercentage', 'latePercentage', 'totalEmployees', 'totalSalary', 'employeeSalaries'));
    }


    // Profile

    function profiles($id)
    {
        $profile = Users::Where('id', $id / 548548)->first();
        return view('dashboard.Users.profile', compact('profile'));
    }

    // function edit($id)
    // {
    //     $user = Users::Where('id', $id/548548)->first();
    //     return view('dashboard.Users.edit', compact('user'));

    // }

    function update(Request $req, $id)
    {
        $req->validate([
            'name' => 'required | max:50 | min:3',
        ]);

        $profile = Users::find($id);
        $imgname = $profile->img;
        if ($req->hasfile('img')) {

            $img = $req->img;
            $imgname = $img->getClientOriginalName();
            $imgname = time() . "__" . $imgname;
            $img->move("images/Userimages/", $imgname);
            $imgname = "/images/Userimages/" . $imgname;
            if ($profile->img) {
                if (file_exists(public_path($profile->img))) {
                    unlink(public_path($profile->img));
                }
            }
        }

        $profile->name = $req->name;
        $profile->img = $imgname;
        // if (session()->has('role') && session('role') == 1){

        //     $profile->role = $req->role;
        //     $profile->status = $req->status;
        // }

        $profile->save();

        return redirect('/');

    }

    function pasupdate(Request $req, $id)
    {
        $req->validate([
            'pass' => 'required | min:6'
        ]);


        $profile = Users::find($id);

        $profile->password = Hash::make($req->pass);

        $profile->save();

        return redirect('/');


    }

}
