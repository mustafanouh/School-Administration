<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Employee extends Model
{

    use Searchable;


    public function toSearchableArray()
    {
        return [
            'id'    => (int) $this->id,
            'name'  => $this->first_name . ' ' . $this->last_name,
        ];
    }
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
    public function attendances()
    {
        return $this->hasMany(StaffAttendance::class, 'employee_id');
    }
}
