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
        return $this->belongsTo('app/Student', 'student_id', 'id');
    }

    public function getSubject()
    {
        return $this->belongsTo('app/Subject', 'subject_id', 'id');
    }
    
}
