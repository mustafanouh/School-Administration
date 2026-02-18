<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Mark;

class Exam extends Model
{
    protected $fillable = [
        'subject_id',
        'semester_id',
        'exam_type',
        'max_mark'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
