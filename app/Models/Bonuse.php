<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonuse extends Model
{
    //
    use HasFactory;
    protected $table = 'bonuses';
    protected $primarykey = 'id';

    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function TransactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_types_id');
    }
    
}
