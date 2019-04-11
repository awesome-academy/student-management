<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    //
    protected $table = 'transcripts';
    public $timestamp = false;

    public function getStudent()
    {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }

    public function getClass()
    {
        return $this->belongsTo('App\Sclass', 'class_id', 'id');
    }
    
}
