<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectRegistration extends Model
{
    //
    protected $table = 'subject_registration';
    protected $fillable = [
        'total_credit',
        'student_id',
        'registration_information_id',
    ];

    public $timestamp = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    
    public function getStudent()
    {
        return $this->belongsTo('App\Student');
    }

    public function getRegistrationInformation()
    {
        return $this->belongsTo('App\RegistrationInformation');
    }

    public function getClass()
    {
        return $this->belongsToMany('App\Class', 'class_subject_registration', 'subject_registration_id', 'class_id');
    }

}
