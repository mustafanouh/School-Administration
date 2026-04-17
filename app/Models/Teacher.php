<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employee;
use App\Models\TeacherSubject;

class Teacher extends Model
{
    protected $fillable = ['employee_id', 'specialization', 'stage'];

    protected $casts = [
        'hire_date' => 'date',
        'is_active' => 'boolean',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function subjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }
}
