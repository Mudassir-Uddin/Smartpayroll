<?php

namespace App\Observers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Carbon;

class AttendanceObserver
{
    public function created(Attendance $attendance)
    {
        $this->updateAttendanceDetails($attendance);
    }

    public function updated(Attendance $attendance)
    {
        $this->updateAttendanceDetails($attendance);
    }

    private function updateAttendanceDetails(Attendance $attendance)
    {
        $timeIn = $attendance->time_in ? Carbon::parse($attendance->time_in) : null;
        $timeOut = $attendance->time_out ? Carbon::parse($attendance->time_out) : null;
        $attendanceDate = Carbon::parse($attendance->date);
    
        $expectedTimeIn = Carbon::createFromTime(8, 0, 0); // Shift starts at 8:00 AM
        $lateThreshold = Carbon::createFromTime(8, 45, 0); // Late if after 8:45 AM
        $minimumRequiredTimeOut = Carbon::createFromTime(16, 45, 0); // Should stay till 4:45 PM
        $earlyEntryStart = Carbon::createFromTime(7, 0, 0); // Consider early if before 8:00 AM
    
        // **OLD values retain karein**
        $previousLateMinutes = $attendance->getOriginal('late_minutes', 0);
        $previousTotalLate = $attendance->getOriginal('total_late', 0);
    
        // **Default values reset**
        $attendance->late_minutes = 0;
        $attendance->total_absent = 0;
        $attendance->total_present = 0;
        $attendance->total_late = $previousTotalLate;
        $attendance->early_exit_minutes = 0; // Reset early exit minutes
    
        // ✅ **Fix: Late only if time_out is NOT NULL**
        // if ($timeIn && $timeOut) {  
        //     if ($timeIn->greaterThanOrEqualTo($expectedTimeIn) && $timeIn->lessThanOrEqualTo($lateThreshold)) {
        //         if ($previousLateMinutes == 0) { // ✅ Only increment if not counted before
        //             $attendance->total_late = 1;
        //         }
        //         $attendance->late_minutes = $timeIn->diffInMinutes($expectedTimeIn);
        //     }
        // }
        
        if ($timeIn && $timeOut) { 
            if ($timeIn->greaterThan($expectedTimeIn) && $timeIn->lessThanOrEqualTo($lateThreshold)) {
                $attendance->total_late = 1; // ✅ Sirf 1 baar count hoga
            } else {
                $attendance->total_late = 0; // ✅ Agar time_in sahi hai toh reset ho jayega
            }
        }
    
    
        // ✅ **Fix: Early entry minutes calculation**
        if ($timeIn && $timeIn->lessThan($expectedTimeIn) && $timeIn->greaterThanOrEqualTo($earlyEntryStart)) {
            $attendance->early_exit_minutes = $expectedTimeIn->diffInMinutes($timeIn);
        }
    
        // **Absent Conditions Fix**
        if (!$timeIn || !$timeOut) {
            $attendance->total_absent = 1;  // Agar kisi ka bhi time_in ya time_out missing hai, absent
        } elseif ($timeOut && $timeOut->lessThan($minimumRequiredTimeOut)) {
            $attendance->total_absent = 1;  // Agar time_out 4:45 se pehle hai, absent
            $attendance->total_late = $previousTotalLate; // ✅ Late count na ho
            $attendance->late_minutes = 0; // ✅ Late minutes reset
        } elseif ($timeIn->greaterThan($lateThreshold)) {
            $attendance->total_absent = 1;  // Agar 8:45 ke baad aaya to absent
        } 

        // ✅ **Present Condition (Only if Not Absent)**
        if ($timeIn && $timeOut && !$attendance->total_absent) {
            $attendance->total_present = 1;
        }
    
        // **Salary Calculation**
        $employee = Employee::find($attendance->employee_id);
        if ($employee) {
            $dailySalary = round($employee->Designation->basic_salary / 26, 2);
    
            if ($attendance->total_absent == 1) {
                $attendance->daily_salary = 0;
            } else {
                $attendance->daily_salary = $dailySalary;
            }
    
            // **Late Deduction**  
            $monthlyLateCount = Attendance::where('employee_id', $attendance->employee_id)
                ->whereMonth('date', $attendanceDate->month)
                ->whereYear('date', $attendanceDate->year)
                ->where('total_late', '>=', 3)
                ->count();
    
            if ($monthlyLateCount >= 3) {
                $attendance->daily_salary -= $dailySalary;
            }
    
            // **Total Salary Calculation**
            $previousTotalSalary = Attendance::where('employee_id', $attendance->employee_id)
                ->whereMonth('date', $attendanceDate->month)
                ->whereYear('date', $attendanceDate->year)
                ->where('id', '!=', $attendance->id)
                ->sum('daily_salary');
    
            $attendance->total_salary = $previousTotalSalary + $attendance->daily_salary;
        }
    
        // ✅ **Fix: Ensure it saves properly**
        $attendance->saveQuietly();
    }
}
