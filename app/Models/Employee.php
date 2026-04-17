<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Employee extends Model implements HasMedia
{
    use  Searchable, InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('employee_profile_photos')
            ->singleFile();
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Contain, 150, 150)
            ->nonQueued();
    }
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
        'hire_data',
        'job_title',
        'user_id',
        'photo',
    ];
    public function teacher()
    {
       
        return $this->hasOne(Teacher::class, 'employee_id');
    }

  


    public function staffAttendances()
    {
        return $this->hasMany(StaffAttendance::class, 'employee_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
