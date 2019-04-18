S<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    protected $table = 'semesters';
    public $timestamp = false;

    public function getClass()
    {
        return $this->hasMany('App\Class');
    }

}
