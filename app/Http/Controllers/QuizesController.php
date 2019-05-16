<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use Auth;

use App\Quiz;

use App\QuizQuestion;

use App\QQsAnswer;

use App\QuizParticipation;

use App\QuizResult;

class QuizesController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function createQuiz(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'topic'=>'required',
            'key'=>'required',
            'mcq'=>'numeric',
            'fig'=>'numeric',
            'time'=>'required|numeric']);

        if($request->mcq<1&&$request->fig<1)
        {
            Session::flash('error','You must have atleast one question');
            return redirect()->back();
        }

        if($request->mcq<1)
            $request->mcq==0;

        if($request->fig<1)
            $request->fig==0;

        // dd($request);
        $quiz=Quiz::create([
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'topic'=>$request->topic,
            'key'=>$request->key,
            'mcq'=>$request->mcq,
            'fig'=>$request->fig,
            'time'=>$request->time,
            'message'=>$request->message
        ]);

        session(['mcqs' => $quiz->mcq]);
        session(['figs' => $quiz->fig]);
        session(['quiz_id'=>$quiz->id]);

        return redirect()->route('onlineExam.create.setQuestionAnswer',['q_id'=>$quiz->id]);


    }

    public function setQuestionAnswer($q_id)
    {
        # code...
        $quiz=Quiz::find($q_id);
        return view('quiz.questionAnswer')->with('mcqs',$quiz->mcq)
                                        ->with('figs',$quiz->fig)
                                        ->with('quiz_id',$q_id);
    }

    public function questionanswer(Request $request)
    {
        if(session('quiz_id')!=$request->quiz_id)
        {
            Session::flash('error','Invalid Request');
            return redirect()->back();
        }

        $this->validate($request,[
            'marks.*'=>'required|numeric',
            'questions.*'=>'required',
            'answers.*.*'=>'required'
        ]);

        $count=0;

        for($i=0;$i<session('mcqs');$i++) {

            $qques=QuizQuestion::Create([
                'quiz_id'=>session('quiz_id'),
                'question'=>$request->questions[$i],
                'question_type'=>'MCQ',
                'marks'=>$request->marks[$i]
            ]);
            $count=0;

            foreach ($request->answers[$i] as $answer) {
                $qans=new QQsAnswer;

                $qans->quiz_question_id=$qques->id;
                $qans->answer=$answer;
                if($count==0)
                    $qans->correct="1";
                $qans->save();
                $count++;
            }

            
        }
        for($i=session('mcqs');$i<session('figs')+session('mcqs');$i++)
        {

            $qques=QuizQuestion::Create([
                'quiz_id'=>session('quiz_id'),
                'question'=>$request->questions[$i],
                'question_type'=>'Fill In The Gaps',
                'marks'=>$request->marks[$i]
            ]);


            
        }



        return redirect()->route('onlineExam.view',['id'=>$request->quiz_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        //
        $quiz=Quiz::find($id);
        return view('quiz.view')->with('quiz',$quiz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function participate()
    {
        return view('quiz.participate');
    }

    public function quiz_info(Request $request)
    {
        $this->validate($request,[
            'quiz_id'=>'required|numeric',
            'secret_key'=>'required']);
        $quiz=Quiz::find($request->quiz_id);

        if($quiz->enabled==0)
        {
            Session::flash('error','This quiz not available now');
            return redirect()->back();
        }

        if(count($quiz->QuizQuestions)>0)
        {
            return view('quiz.info')
            ->with('quiz',$quiz);
        }
        Session::flash('These credentials do not match our records.');
        return redirect()->back();
    }

    public function start(Request $request)
    {
        $this->validate($request,[
            'quiz_id'=>'required']);
        $quiz_id=decrypt($request->quiz_id);
        session(['quiz_id'=>$quiz_id]);

        return view('quiz.startexam')
                ->with('quiz',Quiz::find($quiz_id));
    }

    public function submit(Request $request)
    {
        $this->validate($request,[
            'quiz_id'=>'required'
        ]);
        $quiz_id=decrypt($request->quiz_id);

        if(session('quiz_id')!=$quiz_id)
        {
            Session::flash('error','Invalid Request');
            return redirect()->back();
        }

        // return $request->answer;

        $quiz=Quiz::find($quiz_id);

        $quiz_participation=QuizParticipation::create([
            'quiz_id'=>$quiz_id,
            'user_id'=>Auth::id()
        ]);

        $count=0;
        $marks=0;
        foreach($quiz->QuizQuestions as $question)
        {
            // echo  $question->correctAnswer();
            $result=new QuizResult;
            $result->quiz_participation_id=$quiz_participation->id;
            $result->quiz_question_id=$question->id;

            if($request->answer[$count])
            {
                $result->answer=$request->answer[$count];
            }
            else
            {
                $result->answer="";
            }

            if($request->answer[$count]==$question->correctAnswer()&&$question->question_type!="Fill In The Gaps")
            {
                $result->marks=$question->marks;
            }
            else
                $result->marks="0";

            $result->save();

            $marks+=$result->marks;

            $count++;
        }

        $quiz_participation->marks=$marks;
        $quiz_participation->save();



        return view('quiz.resultsheet')
                    ->with('quiz',$quiz)
                    ->with('quiz_participation',$quiz_participation);




    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
