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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('users');
            $table->foreignId('section_id')->references('id')->on('sections');
            $table->foreignId('academic_year_id')->references('id')->on('academic_years');
            $table->foreignId('track_id')->references('id')->on('tracks');
            $table->enum('status', ['enrolled', 'graduated', 'dropped'])->default('enrolled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
