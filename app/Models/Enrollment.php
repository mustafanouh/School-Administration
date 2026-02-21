<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Student;
use App\Models\Section;
use App\Models\AcademicYear;
use App\Models\Track;
use App\Models\Mark;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'section_id',
        'academic_year_id',
        'track_id',
        'status',
        'enrollment_date',
    ];
    protected $casts = [
        'enrollment_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
