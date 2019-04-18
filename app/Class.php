<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
    //
    protected $table = 'classes';
    public $timestamp = false;

    public function getSubject()
    {   
        return $this->belongsTo('App\Subject');
    }

    public function getLesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function getDay()
    {
        return $this->belongsTo('App\Day');
    }

    public function getSemester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function getRegistrationInformation()
    {
        return $this->hasMany('App\RegistrationInformation');
    }

    public function getSubjectRegistration ()
    {
        return $this->belongsToMany('App\SubjectRegistration', 'class_subject_registration', 'class_id',
            'subject_registration_id');
    }
}
