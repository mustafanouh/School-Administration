<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicYearsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('academic_years', function (Blueprint $table) {
            // العمود الأساسي (ID)
            $table->id();
            
            // اسم السنة الدراسية
            $table->string('name')->unique();
            
            // هل السنة مفعلة أم لا
            $table->boolean('is_active')->default(false);
            
            // وقت الإنشاء والتحديث
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('academic_years');
    }
}