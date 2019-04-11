<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationInformation extends Model
{
    //
    protected $table = 'registration_information';
    public $timestamp = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'id',
        'status',
        'time_begin',
        'date_begin',
        'time_finish',
        'date_finish',
        'min_credits',
        'max_credits',
        'admin_id',
        'department_id',
    ];

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
        return $this->hasMany('AppSclass');
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
