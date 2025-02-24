<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Month;
use App\Models\Salary;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AttendancesController extends Controller
{
    //
    // public function index(){
    //     $Employee = Employee::all();
    //     $Attendances = Attendance::all();
    //     return view('Dashboard.Attendances.index',compact('Attendances','Employee'));
    // }
    
    public function index(Request $request)
{
    $query = Attendance::query();

       // **Agar sirf month filter kiya gaya hai, to us month ka filter lagayein**
   if ($request->filled('month')) {
        $query->whereMonth('date', $request->month);
    }

    // **Agar employee_id select nahi kiya, to filtering na karein**
    if ($request->filled('employee_id')) {
        $query->where('employee_id', $request->employee_id);
    }

    $Attendances = $query->with('employee')->get();
    $employees = Employee::all();
    $months = Month::all();
    return view('Dashboard.Attendances.index',compact('Attendances','employees','months'));
}


    public function Insert(){
        $employee_Id = Employee::all();
        return view('Dashboard.Attendances.insert',compact('employee_Id'));
    }
    public function Store(Request $req) {
        $req->validate([
            'employee_id' => 'required',
            'date' => 'required',
            'status' => 'required',
            'time_in' => 'nullable',
            'time_out' => 'nullable',
        ]);
    
        $timeIn = $req->time_in ? Carbon::parse($req->time_in) : null;
        $timeOut = $req->time_out ? Carbon::parse($req->time_out) : null;
        
        // **Worked Hours Calculation**
        $workedHours = ($timeIn && $timeOut) ? $timeOut->diffInHours($timeIn) : 0;
    
        // **Overtime Calculation**
        $overtimeHours = max(0, $workedHours - 9);
    
        // **Late Minutes Calculation (Only if time_out is NOT NULL)**
        $lateMinutes = 0;
        if ($timeIn && $timeOut) { 
            $scheduledTimeIn = Carbon::parse('08:00'); 
            $lateMinutes = ($timeIn->greaterThan($scheduledTimeIn)) ? $timeIn->diffInMinutes($scheduledTimeIn) : 0;
        }
    
        // **Early Exit Minutes Calculation**
        $earlyExitMinutes = 0;
        if ($timeOut) { // **Only calculate if time_out is present**
            $scheduledTimeOut = Carbon::parse('17:00');
            if ($timeOut->lessThan($scheduledTimeOut)) {
                $earlyExitMinutes = $scheduledTimeOut->diffInMinutes($timeOut);
            }
        }
    
        // **Fetch Employee Salary**
        $employee = Employee::findOrFail($req->employee_id);
        $dailySalary = round($employee->Designation->basic_salary / 26, 2);
    
        // **If either time_in or time_out is null, set status = 2 (Incomplete)**
        $status = ($timeIn === null || $timeOut === null) ? 2 : $req->status;
    
        Attendance::updateOrCreate(
            ['employee_id' => $req->employee_id, 'date' => $req->date],
            [
                'status' => $status,
                'time_in' => $req->time_in,
                'time_out' => $req->time_out,
                'worked_hours' => $workedHours,
                'overtime_hours' => $overtimeHours,
                'late_minutes' => $lateMinutes,   // ✅ Late only if time_out is present
                'early_exit_minutes' => $earlyExitMinutes,  // ✅ Early Exit calculated correctly
                'daily_salary' => $dailySalary,
            ]
        );
    
        return redirect()->back()->with('success', 'Attendance recorded successfully!');
    }
    
    
    public function Edit($id){

        $Employee_Id = Employee::all();
        $Attendance = Attendance::Where('id', $id/548548)->first();;
        return view('Dashboard.Attendances.edit', compact('Attendance','Employee_Id'));
    }
    public function Update(Request $req, $id)
    {
        $attendance = Attendance::findOrFail($id);
    
        $timeIn = $req->time_in ? Carbon::parse($req->time_in) : null;
        $timeOut = $req->time_out ? Carbon::parse($req->time_out) : null;
    
        $scheduledTimeIn = Carbon::parse('08:00'); 
        $scheduledTimeOut = Carbon::parse('17:00');
    
        $lateMinutes = 0;
        $total_late = $attendance->total_late; // Get previous total_late
    
        if ($timeIn && $timeOut) { 
            if ($timeIn->greaterThan($scheduledTimeIn)) {
                $lateMinutes = $timeIn->diffInMinutes($scheduledTimeIn);
    
                // ✅ Always increment total_late if employee is late
                $total_late = Attendance::where('employee_id', $attendance->employee_id)
                    ->whereMonth('date', Carbon::parse($req->date)->month)
                    ->whereYear('date', Carbon::parse($req->date)->year)
                    ->sum('total_late'); 
    
                $total_late += 1;
            }
        }
    
        $earlyExitMinutes = 0;
        if ($timeOut && $timeOut->lessThan($scheduledTimeOut)) {
            $earlyExitMinutes = $scheduledTimeOut->diffInMinutes($timeOut);
        }
    
        $workedHours = ($timeIn && $timeOut) ? $timeOut->diffInHours($timeIn) : 0;
        $overtimeHours = max(0, $workedHours - 9);
        $dailySalary = round($attendance->employee->Designation->basic_salary / 26, 2);
    
        $attendance->update([
            'employee_id' => $req->employee_id,
            'date' => $req->date,
            'status' => $req->status,
            'time_in' => $req->time_in,
            'time_out' => $req->time_out,
            'worked_hours' => $workedHours,
            'overtime_hours' => $overtimeHours,
            'late_minutes' => $lateMinutes,
            'early_exit_minutes' => $earlyExitMinutes,
            'total_late' => $total_late, // ✅ Fixed Total Late Calculation
            'daily_salary' => $dailySalary,
        ]);
    
        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully.');
    }
    
    

    public function Delete($id){
        $Attendance = Attendance::find($id);
        $Attendance->delete();
        return redirect('/Attendances');
    }
}