<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');        

            $table->unsignedBigInteger('month_id');
            $table->foreign('month_id')->references('id')->on('months')->onDelete('cascade');
        
            $table->unsignedBigInteger('attendance_id')->nullable();
            $table->foreign('attendance_id')->references('id')->on('attendance')->onDelete('cascade');
        
            $table->smallInteger('year'); // Auto-filled with current year
            $table->decimal('basic_salary', 10, 2); // Fixed salary of employee
            $table->integer('total_present')->default(0);
            $table->integer('total_absent')->default(0);
            $table->integer('total_late')->default(0);
            $table->decimal('deductions', 10, 2)->default(0); // Tax + Late + Absence deductions combined
            $table->decimal('bonuses', 10, 2)->default(0); // Bonuses if any
            $table->decimal('net_salary', 10, 2)->default(0); // Final salary after deductions & bonuses
            $table->boolean('status')->default(0); // 0 = Unpaid, 1 = Paid
            $table->date('payment_date')->nullable(); // Payment date when salary is released
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
