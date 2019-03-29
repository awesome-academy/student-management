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
    	return $this->hasMany('app/Feedback', 'student_id', 'id');
    }

    public function getTranscript()
    {
    	return $this->hasMany('app/Transcript', 'student_id', 'id');
    }

    public function getGeneration()
    {
    	return $this->belongsTo('app/Generation', 'generation_id', 'id');
    }

    public function getDepartment()
    {
    	return $this->belongsTo('app/Department', 'department_id', 'id');
    }

    public function getSubjectRegistration()
    {
    	return this->hasMany('app/SubjectRegistration', 'student_id', 'id');
    }
    
}
