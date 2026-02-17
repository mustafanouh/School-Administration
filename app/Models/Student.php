<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enrollment;
class Student extends Model
{
      protected $fillable = ['first_name', 'lastName'];

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
}
