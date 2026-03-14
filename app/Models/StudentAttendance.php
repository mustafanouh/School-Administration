<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;


    protected $fillable = [
        'enrollment_id',
        'section_id',
        'attendance_date',
        'status',
        'notes'
    ];

    protected $casts = [
        'attendance_date' => 'date',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }


    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
