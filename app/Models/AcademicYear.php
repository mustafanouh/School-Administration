<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Semester;
use App\Models\Section;
use App\Models\Enrollment;


class AcademicYear extends Model
{
  protected $fillable = ['name', 'is_active'];

  //إضافة سكوب أكتيف للسنة المفعلة حاليا
  public function scopeActive($query)
  {
    return $query->where('is_active', true);
  }

  public function scopeInactive($query)
  {
    return $query->where('is_active', false);
  }
  //للتحقق من وجود قيود 
  public function hasEnrollments()
  {
    return $this->enrollments()->count() > 0;
  }

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
