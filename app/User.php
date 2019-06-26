<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'varsity_id', 'u_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function notices()
    {
        return $this->hasMany('App\Notice');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Quiz');
    }
    public function participated($quiz_id,$participation_id=NULL)
    {
        $quiz=Quiz::find($quiz_id);

        foreach($this->QuizParticipation as $user_quiz_participation)
        {
            if($user_quiz_participation->Quiz==$quiz&&$user_quiz_participation->id!=$participation_id)
                return true;
        }
        return false;
    }

    public function QuizParticipation()
    {
        return $this->hasMany('App\QuizParticipation');
    }

    public function admin()
    {
        if($this->u_type=='Admin')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function office_stuff()
    {
        if($this->u_type=='Office Stuff')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function teacher()
    {
        if($this->u_type=='Teacher')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function student()
    {
        if($this->u_type=='Student')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
