<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enrollment;
use Laravel\Scout\Searchable;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Student extends Model implements HasMedia
{
    use Searchable, InteractsWithMedia;
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('student_profile_photos')
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
        'photo', 
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
