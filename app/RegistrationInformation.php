<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationInformation extends Model
{
    //
    protected $table = 'registration_information';
    public $timestamp = false;

    public function getGeneration()
    {
    	return $this->belongsToMany(
            'App\Generation',
            'generation_registration_information',
            'registration_information_id',
            'generation_id'
        );
    }

    public function getDepartment()
    {
        return $this->belongsTo('App\Department');
    }

    public function getSubjectRegistration()
    {
        return $this->hasMany('App\SubjectRegistration');
    }

    public function getClass()
    {
        return $this->hasMany('App\Class');
    }

    public function getSubject()
    {
        return $this->belongsToMany(
            'App\Subject',
            'registration_information_subject',
            'registration_information_id',
            'subject_id'
        );
    }
}
