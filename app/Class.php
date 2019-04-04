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
    	return $this->belongsTo('app/Subject', 'subject_id', 'id');
    }

    public function getLesson()
    {
    	return $this->belongsTo('app/Lesson', 'lesson_id', 'id');
    }

    public function getDay()
    {
    	return $this->belongsTo('app/Day', 'day_id', 'id');
    }

    public function getSemester()
    {
    	return $this->belongsTo('app/Semester', 'semester_id', 'id');
    }

    public function getRegistrationInformation()
    {
    	return $this->hasMany('app/RegistrationInformation', 'registration_information_id', 'id');
    }

    public function getSubjectRegistration ()
    {
        return $this->belongsToMany('app/SubjectRegistration', 'class_subject_registration', 'class_id',
            'subject_registration_id');
    }
}
