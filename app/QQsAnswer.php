<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QQsAnswer extends Model
{
    //
    protected $fillable=['quizquestion_id','answer','correct'];

    public function QuizQuestion()
    {
    	return $this->belongsTo('App\QuizQuestion');
    }
}
