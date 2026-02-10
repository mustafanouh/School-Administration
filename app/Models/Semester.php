<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AcademicYear;
use App\Models\Stage;
use App\Models\Exam;
class Semester extends Model
{
     protected $fillable = ['academic_year_id', 'name'];
     public function academicYear()
     {
        return $this->belongsTo(AcademicYear::class);
     }
       public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
