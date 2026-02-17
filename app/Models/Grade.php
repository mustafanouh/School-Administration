<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Stage;
use App\Models\Section;
use App\Models\Subject;

class Grade extends Model
{
    protected $fillable = ['name', 'stage_id', 'next_grade_id'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function nextGrade()
    {
        // المرحلة التالية
        return $this->belongsTo(Grade::class, 'Next_Grade_id');
    }

    public function previousGrade()
    {
        // المرحلة السابقة (علاقة عكسية)
        return $this->hasOne(Grade::class, 'Next_Grade_id');
    }
}
