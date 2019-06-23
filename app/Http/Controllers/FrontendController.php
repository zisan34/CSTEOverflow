<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Tag;
use App\Post;
use Auth;

class FrontendController extends Controller
{
    //
    public function onlineExam()
    {
    	return view('onlineExam')->with('quizzes',Auth::user()->quizzes()->get());
    }
    public function welcome()
    {
    	return view('welcome')->with('tags',Tag::all())
    							->with('posts',Post::orderBy('created_at','DESC')->paginate(8));
    }
}
