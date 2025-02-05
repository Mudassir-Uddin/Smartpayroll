<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    use HasFactory;
    protected $table = 'attendance';
    protected $primaryKey = 'id';

    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
    
}
