<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'gender',
        'birthdate',
        'phone_number',
        'education',
        'address',
        'hiring_date',
        'subject',
        'duration',
        'academy_class_id',
        'salary',
        'archive',
        'img',
    ];
    public function academyClass()
    {
        return $this->belongsTo(AcademyClass::class);
    }
    public function absences()
    {
        return $this->hasMany(TeacherAbsence::class);
    }

    public function salaries ()
    {
        return $this->hasMany(Salary::class);
    }


}
