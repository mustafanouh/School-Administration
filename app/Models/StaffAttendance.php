<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'attendance_date',
        'status',
        'check_in',
        'check_out',
        'notes'
    ];
    protected $casts = [
    'attendance_date' => 'date',
];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
