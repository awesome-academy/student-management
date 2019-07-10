<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    //
    protected $table = 'generations';
    protected $fillable = [
        'id',
        'name',
        'begin_year',
    ];
    public $timestamp = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function getStudent()
    {
        return $this->hasMany('App\Student', 'generations_id', 'id');
    }

    public function getRegistrationInformation()
    {
        return $this->belongsToMany('App\RegistrationInformation', 'generation_registration_information', 'generation_id',
            'registration_information_id');
    }
}
