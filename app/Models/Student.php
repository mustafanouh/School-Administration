<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enrollment;
use Laravel\Scout\Searchable;

class Student extends Model
{
    use Searchable;


    public function toSearchableArray()
    {
        return [
            'id'    => (int) $this->id,
            'name'  => $this->first_name . ' ' . $this->last_name,
            'grade' => $this->enrollments->first()?->section?->grade?->name,
        ];
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'nationality',
        'address',
        'phone_number',
        'mother_name',
        'mother_phone_number',
        'mother_email',
        'father_name',
        'father_phone_number',
        'father_email',
        'blood_group',
        'user_id',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function sections()
    {
        return $this->hasManyThrough(
            Section::class,
            Enrollment::class,
            'student_id',
            'id',
            'id',
            'section_id'
        );
    }
    public function attendances()
    {
        return $this->hasManyThrough(
            StudentAttendance::class,
            Enrollment::class,
            'student_id',
            'enrollment_id',
            'id',
            'id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
