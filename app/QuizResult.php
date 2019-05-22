<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    //
    public function QuizQuestion()
    {
    	return $this->belongsTo('App\QuizQuestion');
    }

    public function QuizParticipation()
    {
    	return $this->belongsTo('App\QuizParticipation');
    }


}
