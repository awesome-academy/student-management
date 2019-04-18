<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table = 'subjects';
    public $timestamp = false;

    public function getRatePoint()
    {
        return $this->belongsTo('app/RatePoint', 'rate_point_id', 'id');
    }

    public function getTranscript()
    {
        return $this->hasMany('app/Transcript', 'subject_id', 'id');
    }

    public function getClass()
    {
        return $this->hasMany('app/Class', 'subject_id', 'id');
    }

    public function getRegistrationInformation()
    {
        return $this->belongsToMany('app/RegistrationInformation', 'registration_information_subject', 'subject_id',
            'registration_information_id');
    }

}
