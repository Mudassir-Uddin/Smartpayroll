<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'month_id', 'year', 'basic_salary', 'total_present',
        'total_absent', 'total_late', 'deductions', 'bonuses', 'net_salary',
        'status', 'payment_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
    public function deduction()
    {
        return $this->belongsTo(Deduction::class);
    }
    public function bonuses()
    {
        return $this->belongsTo(Bonuse::class);
    }
    
};


