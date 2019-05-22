<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use Auth;

use Crypt;

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
            'true_false'=>'numeric',
            'short_ques'=>'numeric',
            'fig'=>'numeric',
            'time'=>'required|numeric',
            'total_marks'=>'required|numeric',
            'show_correct'=>'required|boolean',
            'multiple_attempt'=>'required|boolean'
        ]);


        if($request->mcq+$request->fig+$request->short_ques+$request->true_false<1)
        {
            Session::flash('error','You must have atleast one question');
            return redirect()->back();
        }

        if($request->mcq<1)
            $request->mcq==0;

        if($request->fig<1)
            $request->fig==0;

        if($request->true_false<1)
            $request->true_false==0;

        if($request->short_ques<1)
            $request->short_ques==0;

        // dd($request);
        $quiz=Quiz::create([
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'topic'=>$request->topic,
            'key'=>$request->key,
            'mcq'=>$request->mcq,
            'true_false'=>$request->true_false,
            'fig'=>$request->fig,
            'short_ques'=>$request->short_ques,
            'time'=>$request->time,
            'message'=>$request->message,
            'total_marks'=>$request->total_marks,
            'show_correct'=>$request->show_correct,
            'multiple_attempt'=>$request->multiple_attempt

        ]);

        session(['mcqs' => $quiz->mcq]);
        session(['figs' => $quiz->fig]);
        session(['true_false' => $quiz->true_false]);        
        session(['short_ques'=>$quiz->short_ques]);
        session(['quiz_id'=>$quiz->id]);

        return redirect()->route('onlineExam.create.setQuestionAnswer',['q_id'=>Crypt::encrypt($quiz->id)]);


    }

    public function setQuestionAnswer($q_id)
    {
        # code...
        $id=Crypt::decrypt($q_id);
        $quiz=Quiz::find($id);
        return view('quiz.questionAnswer')->with('mcqs',$quiz->mcq)
                                        ->with('figs',$quiz->fig)
                                        ->with('short_ques',$quiz->short_ques)
                                        ->with('true_false',$quiz->true_false)
                                        ->with('quiz_id',$quiz->id);
    }

    public function storeQuestionAnswer(Request $request)
    {
        $q_id=Crypt::decrypt($request->quiz_id);

        $quiz=Quiz::find(session('quiz_id'));

        if(session('quiz_id')!=$q_id||$quiz->user->id!=Auth::user()->id)
        {
            Session::flash('error','Invalid Request');
            return redirect()->back();
        }



        $this->validate($request,[
            'marks.*'=>'required|numeric',
            'questions.*'=>'required',
            'answers.*.*'=>'required'
        ]);


        $total_marks=0;
        foreach ($request->marks as $marks) {
            $total_marks+=$marks;
        }

        if($total_marks!=$quiz->total_marks)
        {
            Session::flash('error','Total Marks must be '.$quiz->total_marks);
            $request->flash();
            return redirect()->back();
        }

        $count=0;

        //storing mcq ques & ans
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
        //storing true false ques & ans

        for($i=session('mcqs');$i<session('mcqs')+session('true_false');$i++) {

            $qques=QuizQuestion::Create([
                'quiz_id'=>session('quiz_id'),
                'question'=>$request->questions[$i],
                'question_type'=>'True False',
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

        //storing fill in the gaps ques


        for($i=session('mcqs')+session('true_false');$i<session('figs')+session('mcqs')+session('true_false');$i++)
        {

            $qques=QuizQuestion::Create([
                'quiz_id'=>session('quiz_id'),
                'question'=>$request->questions[$i],
                'question_type'=>'Fill In The Gaps',
                'marks'=>$request->marks[$i]
            ]);


            
        }

        //storing short ques
        for($i=session('figs')+session('mcqs')+session('true_false');$i<session('figs')+session('mcqs')+session('true_false')+session('short_ques');$i++)
        {

            $qques=QuizQuestion::Create([
                'quiz_id'=>session('quiz_id'),
                'question'=>$request->questions[$i],
                'question_type'=>'Short Question',
                'marks'=>$request->marks[$i]
            ]);


            
        }



        return redirect()->route('onlineExam.view',['id'=>$quiz->id]);
    }


    public function editQuiz($id)
    {
        $q_id=decrypt($id);

        $quiz=Quiz::find($q_id);

        if($quiz->user->id==Auth::user()->id)
        {
            return view('quiz.editquiz')->with('quiz',$quiz);
        }

        Session::flash('error','Invalid request');
        return redirect()->back();
    }
    public function updateQuiz(Request $request)
    {
        $this->validate($request,[
            'quiz_id'=>'required',
            'title'=>'required',
            'topic'=>'required',
            'time'=>'required|numeric',
            'key'=>'required',
            'total_marks'=>'required|numeric',
            'show_correct'=>'required|boolean',
            'multiple_attempt'=>'required|boolean'
        ]);
        $id=decrypt($request->quiz_id);

        $quiz=Quiz::find($id);

        $quiz->title=$request->title;
        $quiz->topic=$request->topic;
        $quiz->time=$request->time;
        $quiz->key=$request->key;
        $quiz->total_marks=$request->total_marks;
        $quiz->show_correct=$request->show_correct;
        $quiz->multiple_attempt=$request->multiple_attempt;
        $quiz->message=$request->message;

        $quiz->save();

        return redirect()->route('onlineExam.edit.QA',['id'=>$quiz->id]);

    }

    public function editQA($q_id)
    {
        $quiz=Quiz::find($q_id);
        $mcqs=$quiz->mcq;
        $figs=$quiz->fig;
        $short_ques=$quiz->short_ques;
        $true_false=$quiz->true_false;



        session(['quiz_id'=>$quiz->id]);

        return view('quiz.editQA')->with('quiz',$quiz);
    }
    public function updateQA(Request $request)
    {       
        $quiz=Quiz::find(session('quiz_id'));

        if(session('quiz_id')!=$request->quiz_id||$quiz->user->id!=Auth::user()->id)
        {
            Session::flash('error','Invalid Request');
            return redirect()->back();
        }


        $this->validate($request,[
            'marks.*'=>'required|numeric',
            'questions.*'=>'required',
            'answers.*.*'=>'required'
        ]);


        $total_marks=0;
        foreach ($request->marks as $marks) {
            $total_marks+=$marks;
        }

        if($total_marks!=$quiz->total_marks)
        {
            Session::flash('error','Total Marks must be '.$quiz->total_marks);
            $request->flash();
            return redirect()->back();
        }

        $ques_count=0;

        foreach ($quiz->QuizQuestions as $question) {

            $question->question=$request->questions[$ques_count];
            $question->marks=$request->marks[$ques_count];
            $question->save();
            if($question->question_type=="MCQ")
            {
                $ans_count=0;
                foreach ($question->QQsAnswers as $answer) {
                    $answer->answer=$request->answers[$ques_count][$ans_count];
                    $answer->save();
                    $ans_count++;

                }
            }
            if($question->question_type=="True False")
            {
                $ans_count=0;
                foreach ($question->QQsAnswers as $answer) {
                    $answer->answer=$request->answers[$ques_count][$ans_count];
                    $answer->save();
                    $ans_count++;

                }
            }
            $ques_count++;

        }

        return redirect()->route('onlineExam.view',['id'=>$quiz->id]);




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

    public function disable($id)
    {
        $quiz=Quiz::find($id);
        $quiz->enabled=0;
        $quiz->save();
        return redirect()->back();
    }
    public function enable($id)
    {
        $quiz=Quiz::find($id);
        $quiz->enabled=1;
        $quiz->save();
        return redirect()->back();
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

        if($quiz->key!=$request->secret_key)
        {            
            Session::flash('error','Quiz Id and Secret key doesn\'t match');
            return redirect()->back();
        }


        if($quiz->enabled==0)
        {
            Session::flash('error','This quiz is not available now');
            return redirect()->back();
        }

        if($quiz->multiple_attempt=="0")
        {
            if(Auth::user()->participated($quiz->id))
            {                
                Session::flash('error','Multiple attempt is not allowed for this quiz');
                return redirect()->back();
            }
        }

        if(count($quiz->QuizQuestions)>0)
        {
            return view('quiz.info')
            ->with('quiz',$quiz);
        }
        Session::flash('error','These credentials do not match our records.');
        return redirect()->back();
    }

    public function quizStart(Request $request)
    {
        $this->validate($request,[
            'quiz_id'=>'required']);
        $quiz_id=decrypt($request->quiz_id);
        session(['quiz_id'=>$quiz_id]);

        $quiz=Quiz::find($quiz_id);

        if($quiz->multiple_attempt=="0")
        {
            if(Auth::user()->participated($quiz->id))
            {                
                Session::flash('error','Multiple attempt is not allowed for this quiz');
                return redirect()->back();
            }
        }
        $quiz=Quiz::find($quiz_id);
        $questions=$quiz->QuizQuestions->shuffle();
        session(['questions'=>$questions]);

        session(['time'=>time()]);


        return view('quiz.startexam')
                ->with('quiz',$quiz)
                ->with('questions',$questions);
    }

    public function quizSubmit(Request $request)
    {
        return session('time')." ".time();
        $this->validate($request,[
            'quiz_id'=>'required'
        ]);
        $quiz_id=decrypt($request->quiz_id);
        $questions=session('questions');

        if(session('quiz_id')!=$quiz_id)
        {
            Session::flash('error','Invalid Request');
            return redirect()->back();
        }

        // return $request->answer;

        $quiz=Quiz::find($quiz_id);


        if($quiz->multiple_attempt=="0")
        {
            if(Auth::user()->participated($quiz->id))
            {                
                Session::flash('error','Multiple attempt is not allowed for this quiz');
                return redirect()->back();
            }
        }

        $quiz_participation=QuizParticipation::create([
            'quiz_id'=>$quiz_id,
            'user_id'=>Auth::id()
        ]);

        $count=0;
        $marks=0;

        foreach($questions as $question)
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

            if($request->answer[$count]==$question->correctAnswer()&&$question->question_type!="Fill In The Gaps"&&$question->question_type!="Short Question")
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



        return redirect()->route('onlineExam.result',['$quiz_participation_id'=>Crypt::encrypt($quiz_participation->id)]);




    }

    public function showResult($quiz_participation_id)
    {
        $qp_id=Crypt::decrypt($quiz_participation_id);

        $quiz_participation=QuizParticipation::find($qp_id);

        return view('quiz.resultsheet')
                    ->with('quiz',$quiz_participation->Quiz)
                    ->with('quiz_participation',$quiz_participation);


    }


    public function quizParticipations($id)
    {
        $quiz=Quiz::find($id);
        return view('quiz.participations')->with('quiz',$quiz);
    }
    public function manualCheckParticipation($id)
    {
        $participation=QuizParticipation::find($id);
        return view('quiz.updateParticipation')->with('participation',$participation);
    }
    public function updateFigResult($id)
    {
        $r_id=Crypt::decrypt($id);
        $result=QuizResult::find($r_id);
        $marks=$result->QuizQuestion->marks;
        $result->marks=$marks;
        $result->save();

        $participation=$result->QuizParticipation;

        $total_result=0;

        foreach ($participation->QuizResult as $result) {
            $total_result+=$result->marks;
        }
        $participation->marks=$total_result;
        $participation->save();
        return redirect()->back();
    }
    public function updateSqResult(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
            'marks'=>'required|numeric']);
        $r_id=Crypt::decrypt($request->id);

        $result=QuizResult::find($r_id);


        if($request->marks<0||$request->marks>$result->QuizQuestion->marks)
        {
            Session::flash('error','Marks must be between 0 and '.$result->QuizQuestion->marks);
            return redirect()->back();
        }

        $result->marks=$request->marks;
        $result->save();

        $participation=$result->QuizParticipation;

        $total_result=0;

        foreach ($participation->QuizResult as $result) {
            $total_result+=$result->marks;
        }
        $participation->marks=$total_result;
        $participation->save();
        return redirect()->back();
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
