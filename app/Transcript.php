<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    //
    protected $table = 'transcripts';
    public $timestamp = false;

    public function getStudents()
    {
        return $this->belongsTo('App\Student');
    }

    public function getSubject()
    {
        return $this->belongsTo('App\Subject');
    }
    
}
