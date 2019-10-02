<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    public function files()
    {
    	return $this->hasMany('App\File');
    }
    public function courses()
    {
    	return $this->hasMany('App\Course');
    }
}
