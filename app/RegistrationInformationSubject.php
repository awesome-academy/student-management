<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationInformationSubject extends Model
{
    //
    protected $table = 'registration_information_subject';
    public $timestamp = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'id',
        'registration_information_id',
        'subject_id',
    ];
}
