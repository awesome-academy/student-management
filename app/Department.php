<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'departments';
    public $timestamp = false;

    public function getStudent()
    {
        return $this->hasMany('App\Student');
    }

    public function getRegistrationInformation()
    {
        return $this->hasMany('App\RegistrationInformation');
    }
}
