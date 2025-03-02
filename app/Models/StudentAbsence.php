<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAbsence extends Model
{
    use HasFactory;

    protected $table = 'student_absence';

    protected $fillable = ['student_id', 'academy_class_id', 'duration', 'is_present', 'date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academyClass()
    {
        return $this->belongsTo(AcademyClass::class);
    }

}
