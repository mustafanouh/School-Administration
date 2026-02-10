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
}
