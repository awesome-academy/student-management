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
        return $this->hasMany('app/Student', 'department_id', 'id');
    }

    public function getRegistrationInformation()
    {
        return $this->hasMany('app/RegistrationInformation', 'department_id', 'id');
    }
}
