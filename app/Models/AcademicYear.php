<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Semester;
use App\Models\Section;
use App\Models\Enrollment;


class AcademicYear extends Model
{
      protected $fillable = ['name', 'isActive'];
    
       public function semesters()
        {  
        return $this->hasMany(Semester::class);
        }
          public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
