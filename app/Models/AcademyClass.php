<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademyClass extends Model
{
        /** @use HasFactory<\Database\Factories\AcademyClassFactory> */
        use HasFactory;
    protected $fillable = [
        'name',
        'number_of_seats',
        'taken_seats',
        'available_seats',
        'duration',
        'status',
    ];

    public function teachers() {
        return $this->hasMany(Teacher::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function absences()
    {
        return $this->hasMany(StudentAbsence::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

}
