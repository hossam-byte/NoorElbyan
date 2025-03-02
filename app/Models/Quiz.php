<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    /** @use HasFactory<\Database\Factories\AcademyClassFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'academy_class_id',
        'final_grade',
        'kind',
        'date',
    ];

    public function academyClass()
    {
        return $this->belongsTo(AcademyClass::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
