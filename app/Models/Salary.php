<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //
        //
        use HasFactory;
        protected $table = 'salaries';
        protected $primaryKey = 'id';
        protected $fillable = [
            'employee_id',
            'date',
            'amount',
        ];

        public function Employee()
        {
            return $this->belongsTo(Employee::class, 'employee_id', 'id');
        }
}
