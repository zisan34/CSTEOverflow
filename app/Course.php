<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    public function semester()
    {
    	return $this->belongsTo('App\Semester');
    }
    public function quizzes()
    {
    	return $this->hasMany('App\Quiz');
    }
    public function questions()
    {
    	return $this->hasMany('App\QuizQuestion');
    }
}
