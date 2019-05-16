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
}
