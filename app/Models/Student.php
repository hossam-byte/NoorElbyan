<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'birthdate',
        'father_phone',
        'alt_father_phone',
        'address',
        'duration',
        'academy_class_id',
        'driver_id',
        'pricing_plan',
        'archive',
    ];

    public function academyClass()
    {
        return $this->belongsTo(AcademyClass::class);
    }

    public function absences()
    {
        return $this->hasMany(StudentAbsence::class);
    }
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }


}
