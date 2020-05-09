<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public function results()
    {
        return $this->hasMany('App\Result');
    }
    
    public function poll()
    {
        return $this->belongsTo('App\User');
    }
}
