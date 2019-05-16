<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
    protected $table = 'classes';
    public $timestamp = false;

    public function getSubject()
    {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }

    public function getLesson()
    {
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }

    public function getDay()
    {
        return $this->belongsTo('App\Day', 'day_id', 'id');
    }

    public function getSemester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function getRegistrationInformation()
    {
        return $this->belongsTo('App\RegistrationInformation', 'registration_information_id', 'id');
    }

    public function getSubjectRegistration ()
    {
        return $this->belongsToMany(
            'App\SubjectRegistration',
            'class_subject_registration',
            'class_id',
            'subject_registration_id'
        );
    }
}
