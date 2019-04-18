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
    	return $this->belongsTo('App\Student');
    }

    public function getRegistrationInformation()
    {
    	return $this->belongsTo('App\RegistrationInformation';
    }

    public function getClass()
    {
    	return $this->belongsToMany('App\Class', 'class_subject_registration', 'subject_registration_id', 'class_id');
    }

}
