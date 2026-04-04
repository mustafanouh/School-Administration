<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Grade;
use App\Models\Track;
use App\Models\Exam;
use Laravel\Scout\Searchable;

class Subject extends Model
{

    use Searchable;


    public function toSearchableArray()
    {
        return [
            'id'    => (int) $this->id,
            'name'  => $this->name,
            'min_mark' => $this->min_mark,
            'max_mark' => $this->max_mark,
            'semester' => $this->semester,
        ];
    }
    protected $fillable = ['name', 'grade_id', 'track_id', 'min_mark', 'max_mark', 'semester', 'description'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
