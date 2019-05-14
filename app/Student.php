<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    public $timestamp = false;

    public function getFeedback()
    {
        return $this->hasMany('App\Feedback');
    }

    public function getTranscript()
    {
        return $this->hasMany('App\Transcript');
    }

    public function getGeneration()
    {
        return $this->belongsTo('App\Generation', 'generation_id', 'id');
    }

    public function getDepartment()
    {
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function getSubjectRegistration()
    {
        return $this->hasMany('App\SubjectRegistration');
    }
    
    public function getUser()
    {
        return $this->hasOne('App\User', 'student_id', 'id');
    }
}
