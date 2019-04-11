<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
    protected $table = 'classes';
    public $timestamp = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'id',
        'teacher',
        'class_group',
        'class_room',
        'size',
        'registered',
        'subject_id',
        'registration_information_id',
        'lesson_id',
        'day_id',
    ];

    public function getSubject()
    {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }

    public function getLesson()
    {
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }

    public function getDay()
    {
        return $this->belongsTo('App\Day', 'day_id', 'id');
    }

    public function getRegistrationInformation()
    {
        return $this->belongsTo(
            'App\RegistrationInformation',
            'registration_information_id',
            'id'
        );
    }

    public function getSubjectRegistration ()
    {
        return $this->belongsToMany(
            'App\SubjectRegistration',
            'class_subject_registration',
            'class_id',
            'subject_registration_id'
        );
    }
}
