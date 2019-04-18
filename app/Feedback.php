<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table = 'feedbacks';
    
    public function getStudent()
    {
        return $this->belongsTo('app/Student', 'student_id', 'id');
    }

}
