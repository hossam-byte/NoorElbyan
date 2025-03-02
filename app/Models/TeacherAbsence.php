<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAbsence extends Model
{
    protected $table = 'teachers_absence';

    protected $fillable = ['teacher_id', 'is_present', 'duration', 'date'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }


}
