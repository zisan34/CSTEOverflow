<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //

    protected $fillable = ['user_id','title','topic','key','mcq','fig','true_false','message','time','total_marks','show_correct','multiple_attempt','short_ques'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function QuizQuestions()
    {
    	return $this->hasMany('App\QuizQuestion');
    }    
    public function QuizParticipation()
    {
        return $this->hasMany('App\QuizParticipation');
    }
}

