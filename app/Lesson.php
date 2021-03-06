<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $table = 'lessons';
    public $timestamp = false;

    public function getClass()
    {
        return $this->hasMany('AppSclass', 'lesson_id', 'id');
    }

}
