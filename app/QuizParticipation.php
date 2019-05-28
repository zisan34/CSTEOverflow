<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizParticipation extends Model
{
    //
    protected $fillable=['quiz_id','user_id','marks'];

    public function QuizResult()
    {
        return $this->hasMany('App\QuizResult');
    }
    public function Quiz()
    {
    	return $this->belongsTo('App\Quiz');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function evaluation_complete()
    {
        if($this->QuizResult->count()>0)
        {
            foreach($this->QuizResult as $result)
            {
                if(!$result->marks)
                    return false;
            }            
        return true;
        }
        return false;

    }


    public function next_id()
    { 
        $next = QuizParticipation::where('id', '>', $this->id)->first();

        if($next)
        {
            if($this->Quiz==$next->Quiz)
            return $next->id;
        }
        return;
    }
    public function previous_id()
    { 
        $previous = QuizParticipation::where('id', '<', $this->id)->orderBy('id','DESC')->first();
        if($previous)
        {
            if($this->Quiz==$previous->Quiz)
            return $previous->id;
        }
        return;
    }

}
