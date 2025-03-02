<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /** @use HasFactory<\Database\Factories\AcademyClassFactory> */
    use HasFactory;

    protected $fillable = ['name', 'number_of_seats', 'taken_seats', 'available_seats'];

    public function students() {
        return $this->hasMany(Student::class);
    }

}
