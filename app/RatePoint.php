<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatePoint extends Model
{
    //
    protected $table = 'rate_points';
    public $timestamp = false;

    public function getSubject()
    {
        return $this->hasMany('App\Subject', 'rate_point_id', 'id');
    }
    
}
