<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class FrontendController extends Controller
{
    //
    public function onlineExam()
    {
    	return view('onlineExam')->with('quizzes',Auth::user()->quizzes()->get());
    }
}
