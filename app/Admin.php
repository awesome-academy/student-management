<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admins';

    public function getRegistrationInformation()
    {
        return $this->hasMany('App\RegistrationInformation');
    }

    public function getNofitication()
    {
        return $this->hasMany('App\Notification');
    }

}
