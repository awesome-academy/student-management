<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenerationRegistrationInformation extends Model
{
    //
    protected $table = 'generation_registration_information';
    protected $fillable = [
        'generation_id',
        'registration_information_id',
    ];
    public $timestamp = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;
}
