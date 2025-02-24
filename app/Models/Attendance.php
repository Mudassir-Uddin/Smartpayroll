<?php

namespace App\Models;

use App\Observers\AttendanceObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'employee_id',
        'date',
        'status',
        'time_in',
        'time_out',
        'worked_hours',
        'daily_salary',
        'late_minutes',
        'early_exit_minutes',
        'total_salary',
        'remarks'
    ];

    // Automatically calculate attendance details before saving
    public static function boot()
    {
        parent::boot();

        static::observe(AttendanceObserver::class);
    }

    protected $table = 'attendance';
    protected $primaryKey = 'id';

    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
    public function Designation()
    {
        return $this->belongsTo(Designation::class, 'designation');
    }
}
