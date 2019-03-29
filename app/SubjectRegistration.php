<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectRegistration extends Model
{
    //
    protected $table = 'subject_registration';
    public $timestamp = false;

    public function getStudent()
    {
    	return $this->belongsTo('app/Student', 'student_id', 'id');
    }

    public function getRegistrationInformation()
    {
    	return $this->belongsTo('app/RegistrationInformation', 'registration_information_id', 'id');
    }

    public function getClass()
    {
    	return $this->belongsToMany('app/Class', 'class_subject_registration', 'subject_registration_id', 'class_id');
    }

}
