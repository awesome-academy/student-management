<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admins';

    public function getRegistrationInformation()
    {
    	return $this->hasMany('app/RegistrationInformation', 'admin_id', 'id');
    }

    public function getNofitication()
    {
    	return $this->hasMany('app/Notification', 'admin_id', 'id');
    }

}
