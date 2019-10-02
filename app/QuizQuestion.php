<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    //
    protected $fillable=['quiz_id','question','question_type','marks','course_id'];

    public function Quiz()
    {
    	return $this->belongsTo('App\Quiz');
    }

    public function QQsAnswers()
    {
    	return $this->hasMany('App\QQsAnswer');
    }
    public function correctAnswer()
    {
        $correct="";
        foreach ($this->QQsAnswers as $answer) {
            if($answer->correct=="1")
            {
                $correct=$answer->answer;
                break;
            }
        }
        return $correct;
    }
}
