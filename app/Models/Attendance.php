<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'created_by',
        'date',
        'time',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    //student attendance
    public function studentAttendance()
    {
        return $this->hasMany(StudentAttendance::class, 'attendance_id');
    }
}
