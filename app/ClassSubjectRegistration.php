<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubjectRegistration extends Model
{
    //
    protected $table = 'class_subject_registration';
    public $timestamp = false;
    protected $fillable = [
        'subject_registration_id',
        'class_id',
    ];
}
