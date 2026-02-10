<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Section;
use App\Models\AcademicYear;
class TeacherSubject extends Model
{
       protected $fillable = [
        'teacher_id',
        'subject_id',
        'section_id',
        'academic_year_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
