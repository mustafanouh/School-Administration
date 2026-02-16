<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'phone',
        'address',
        'notional_id',
        'salary',
        'birth_date',
        'status',
        'user_id',
        'hire_data',
        'job_title',
    ];
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }
}
