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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->date('date');
            $table->integer('status');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->decimal('worked_hours',5, 2)->nullable();
            $table->integer('late_minutes')->default(0);
            $table->integer('early_exit_minutes')->default(0);
            $table->integer('total_present')->default(0);
            $table->integer('total_absent')->default(0);
            $table->integer('total_late')->default(0);
            $table->decimal('daily_salary', 8, 2)->nullable();
            $table->decimal('total_salary', 10, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
