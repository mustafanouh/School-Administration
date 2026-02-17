<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = ['name'];
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
