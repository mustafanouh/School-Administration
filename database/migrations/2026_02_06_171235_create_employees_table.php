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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['Male', 'Female ']);
            $table->string('phone');
            $table->string('address');
            $table->string('notional_id')->unique();
            $table->decimal('salary', 10, 2)->default(0);
            $table->date('birth_date');
            $table->enum('status', ['active', 'on_leave','resigned'])->default('active');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->date('hire_data');
            $table->string('job_title');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
