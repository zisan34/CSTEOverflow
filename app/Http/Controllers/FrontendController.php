<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Tag;
use App\Post;
use App\Course;
use Auth;
use DB;

class FrontendController extends Controller
{
    //
    public function onlineExam()
    {
    	return view('onlineExam')->with('quizzes',Auth::user()->quizzes()->get());
    }
    // public function publicExam()
    // {
    //     return view('publicExam')->with('courses',Course::all());
    // }
    public function welcome()
    {
    $popular_tags = DB::table('post_tag')
                     ->select(DB::raw('count(tag_id) as repetition, tag_id'))
                     ->groupBy('tag_id')
                     ->orderBy('repetition', 'desc')
                     ->get()->take(5);
    	return view('welcome')->with('tags',Tag::all())
    							->with('posts',Post::orderBy('created_at','DESC')->paginate(8))
    							->with('popular_tags',$popular_tags);
    }

    // public function startQuiz($id)
    // {
    //     $course=Course::find(decrypt($id));

    //     // $questions=$quiz->QuizQuestions->shuffle();


    //     $questions=$course->questions->shuffle();



    //     session(['start_time'=>time()]);
    //     session(['time_limit'=>"5"]);
    //     session(['questions'=>$questions]);

    //     return view('quiz.startexam')
    //             ->with('quiz',$course)
    //             ->with('questions',$questions);
    // }
}
