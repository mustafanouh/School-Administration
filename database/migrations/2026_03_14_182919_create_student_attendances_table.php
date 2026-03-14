<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('enrollment_id')
                ->constrained('enrollments')
                ->onDelete('cascade');

            $table->foreignId('section_id')
                ->constrained('sections')
                ->onDelete('cascade');

            
            $table->date('attendance_date');

 
            $table->enum('status', ['present', 'absent', 'late', 'excused'])
                ->default('present');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['enrollment_id', 'section_id', 'attendance_date'], 'student_daily_attendance_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
