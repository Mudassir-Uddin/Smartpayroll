<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Employee extends Model
{
    //
    protected static function boot()
    {
        parent::boot();

        // Hook into the creating and updating events
        static::creating(function ($Employee) {
            self::validateEmail($Employee);
        });

        static::updating(function ($Employee) {
            self::validateEmail($Employee);
        });
    }

    /**
     * Validate the uniqueness of the email.
     *
     * @param  \App\Models\User  $Employee
     * @throws \Illuminate\Validation\ValidationException
     */
    protected static function validateEmail($Employee)
    {
        $validator = Validator::make(
            ['email' => $Employee->email],
            ['email' => 'required|email|unique:Employees,email,' . $Employee->id]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
    use HasFactory;
    protected $table = 'employees';
    protected $primaryKey = 'id';
    
    public function Department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function Designation()
    {
        return $this->belongsTo(Designation::class, 'designation');
    }
    
        // Check if employee is late 3 times in a month and deduct one day's salary
        public function checkLateDeductions()
        {
            $lateCount = Attendance::where('employee_id', $this->id)
                ->whereMonth('date', now()->month)
                ->where('late_minutes', '>', 0)
                ->count();
    
            if ($lateCount >= 3) {
                // Deduct one day's salary
                $dailySalary = $this->basic_salary / 30; // Assuming 30 days in a month
                $this->deductSalary($dailySalary);
            }
        }
    
        // Deduct salary and create an entry in the salaries table
        public function deductSalary($amount)
        {
            Salary::create([
                'employee_id' => $this->id,
                'date' => now(),
                'amount' => -$amount, // Deducted amount
            ]);
        }
}
