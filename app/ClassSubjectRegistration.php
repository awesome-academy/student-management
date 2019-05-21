<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubjectRegistration extends Model
{
    //
    protected $table = 'class_subject_registration';
    public $timestamp = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'id',
        'subject_registration_id',
        'class_id',
    ];
}
