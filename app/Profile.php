<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable=['user_id','photo','blood_group','phone','facebook','website','github','linked_in'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
