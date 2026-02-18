<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enrollment;
use App\Models\Exam;

class Mark extends Model
{
    protected $fillable = [
        'enrollment_id',
        'exam_id',
        'score',
        'status',
        'max_mark'
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
