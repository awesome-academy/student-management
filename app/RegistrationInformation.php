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
    	return $this->belongsToMany('app/Generations', 'generation_registration_information', 'registration_information_id',
            'generation_id');
    }

    public function getDepartment()
    {
    	return $this->belongsTo('app/Department', 'department_id', 'id');
    }

    public function getSubjectRegistration()
    {
    	return $this->hasMany('app/SubjectRegistration', 'registration_information_id', 'id');
    }

    public function getClass()
    {
        return $this->hasMany('app/Class', 'registration_information_id', 'id');
    }

    public function getSubject()
    {
        return $this->belongsToMany('app/Subject', 'registration_information_subject', 'registration_information_id',
            'subject_id');
    }
}
