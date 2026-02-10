<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Grade;
use App\Models\Track;
use App\Models\Exam;
class Subject extends Model
{
        protected $fillable = ['name', 'grade_id', 'track_id', 'min_mark'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
