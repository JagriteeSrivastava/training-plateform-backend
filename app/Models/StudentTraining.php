<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTraining extends Model
{
    protected $guarded = [];

    // Define the relationship with Student
    public function student() {
        return $this->belongsTo(Student::class);
    }

    // Define the relationship with Course
    public function course() {
        return $this->belongsTo(Course::class);
    }
    // Define the relationship with TrainingSchedule
    public function trainingSchedule() {
        return $this->belongsTo(TrainingSchedule::class);
    }

}
