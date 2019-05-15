<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    protected $fillable = [
        'id',
        'full_name',
        'birth',
        'if_card',
        'phone',
        'avatar',
        'local_address',
        'current_address',
        'department_id',
        'generation_id',
    ];

    public $timestamp = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function getFeedback()
    {
        return $this->hasMany('App\Feedback', 'student_id', 'id');
    }

    public function getTranscript()
    {
        return $this->hasMany('App\Transcript', 'student_id', 'id');
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
        return $this->hasMany('App\SubjectRegistration', 'student_id', 'id');
    }
    
    public function getUser()
    {
        return $this->hasOne('App\User', 'student_id', 'id');
    }
}
