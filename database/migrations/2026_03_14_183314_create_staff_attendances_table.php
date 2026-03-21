<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->onDelete('cascade');
             $table->foreignId('semester_id')
                ->constrained('semesters')
                ->onDelete('cascade');   

            $table->date('attendance_date');

            $table->enum('status', ['present', 'absent', 'on_leave', 'late'])
                ->default('present');

            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();


            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['employee_id', 'attendance_date'], 'employee_daily_attendance_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_attendances');
    }
};
