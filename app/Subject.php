<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table = 'subjects';
    public $timestamp = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'id',
        'name',
        'credits',
        'lessons',
        'rate_point_id',
    ];

    public function getRatePoint()
    {
        return $this->belongsTo('App\RatePoint', 'rate_point_id', 'id');
    }

    public function getClass()
    {
    	return $this->hasMany('App\Sclass', 'subject_id', 'id');
    }

    public function getRegistrationInformation()
    {
        return $this->belongsToMany(
            'App\RegistrationInformation',
            'registration_information_subject',
            'subject_id',
            'registration_information_id'
        );
    }

}
