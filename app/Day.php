<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    //
    protected $table = 'days';
    public $timestamp = false;

    public function getClass()
    {
        return $this->hasMany('app/Class', 'day_id', 'id');
    }
}
