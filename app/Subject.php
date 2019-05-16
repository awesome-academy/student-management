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
        return $this->belongsTo('App\RatePoint');
    }

    public function getTranscript()
    {
        return $this->hasMany('App\Transcript');
    }

    public function getClass()
    {
    	return $this->hasMany('App\Sclass', 'subject_id', 'id');
    }

    public function getRegistrationInformation()
    {
        return $this->belongsToMany('App\RegistrationInformation', 'registration_information_subject', 'subject_id',
            'registration_information_id');
    }

}
