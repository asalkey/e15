<?php

namespace App;
use App\Result;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function poll()
    {
        return $this->belongsTo('App\Poll');
    }
}
