<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Semester;
use App\Models\Grade;
class Stage extends Model
{
    protected $fillable = ['semester_id', 'name'];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
