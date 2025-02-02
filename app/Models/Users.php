<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Users extends Model
{ //
    protected static function boot()
    {
        parent::boot();

        // Hook into the creating and updating events
        static::creating(function ($user) {
            self::validateEmail($user);
        });

        static::updating(function ($user) {
            self::validateEmail($user);
        });
    }

    /**
     * Validate the uniqueness of the email.
     *
     * @param  \App\Models\User  $user
     * @throws \Illuminate\Validation\ValidationException
     */
    protected static function validateEmail($user)
    {
        $validator = Validator::make(
            ['email' => $user->email],
            ['email' => 'required|email|unique:users,email,' . $user->id]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
    use HasFactory;
    
    protected $table = 'user';
    protected $primaryKey = "id";
    
    // Define default attributes
    protected $attributes = [
        'status' => 1, // Default value for 'status'
    ];
}
