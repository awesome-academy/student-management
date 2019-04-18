<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $table = 'notifications';
    
    public function getAdmin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }
    
}
