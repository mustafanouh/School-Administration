<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Grade;
use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\TeacherSubject;
use Laravel\Scout\Searchable;

class Section extends Model
{


    use Searchable;


    public function toSearchableArray()
    {
        return [
            'id'    => (int) $this->id,
            'name'  => $this->name,
            'capacity' => $this->capacity,
        ];
    }
    protected $fillable = ['name', 'grade_id', 'academic_year_id', 'capacity'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }
}
