<?php

use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $quiz=App\Quiz::create([
        'user_id'=>2,
        'title'=>"CSTE3209 CT2",
        'topic'=>"Software Processes, Models and Agile Software Development",
        'key'=>"CSTE3209_CT2",
        'mcq'=>3,
        'fig'=>1,
        'true_false'=>1,
        'short_ques'=>1,
        'time'=>5,
        'total_marks'=>25,
        'show_correct'=>0,
        'multiple_attempt'=>0
    	]);

    	$questions=array(
    		"Which one of the following is not an Evolutionary Process Model?"
    		,"The Incremental Model is a result of combination of elements of which two models?",
    		"What is the major advantage of using Incremental Model?"
    		,"Spiral Model has user involvement in all its phases."
    		,"Spiral Model doesn’t work well for ______ projects"
    		,"How is WINWIN Spiral Model different from Spiral Model?");

    	$marks = array("3","3","3","3","3","10");



    	$answers=array(
				'0' => array(
					"All of the mentioned",
					"Concurrent Development Model",
					"Incremental Model",
					"WINWIN Spiral Model"
				),
				'1' => array(
					"Linear Model & Prototyping Model",
					"Waterfall Model & RAD Model",
					"Linear Model & RAD Model",
					"Build & FIX Model & Waterfall Model"
				),
				'2' => array(
					"Easier to test and debug & It is used when there is a need to get a product to the market early",
					"It is used when there is a need to get a product to the market early",
					"Easier to test and debug",
					"Customer can respond to each increment"
				),
				'3'=> array(
					"False"
				)
				);
    	//for mcq
    	for($i=0;$i<$quiz->mcq;$i++) {

            $qques=App\QuizQuestion::Create([
                'quiz_id'=>$quiz->id,
                'question'=>$questions[$i],
                'question_type'=>'MCQ',
                'marks'=>$marks[$i]
            ]);
            $count=0;

            foreach ($answers[$i] as $answer) {
                $qans=new QQsAnswer;

                $qans->quiz_question_id=$qques->id;
                $qans->answer=$answer;
                if($count==0)
                    $qans->correct="1";
                $qans->save();
                $count++;
            }

            
        }
        //for true false
    	for($i=$quiz->mcq;$i<$quiz->mcq+$quiz->true_false;$i++) {

            $qques=App\QuizQuestion::Create([
                'quiz_id'=>$quiz->id,
                'question'=>$questions[$i],
                'question_type'=>'True False',
                'marks'=>$marks[$i]
            ]);
            $count=0;

            foreach ($answers[$i] as $answer) {
                $qans=new QQsAnswer;

                $qans->quiz_question_id=$qques->id;
                $qans->answer=$answer;
                if($count==0)
                    $qans->correct="1";
                $qans->save();
                $count++;
            }

            
        }
        //for fill in the gaps
        for($i=$quiz->mcq+$quiz->true_false; $i<$quiz->mcq+$quiz->true_false+$quiz->fig; $i++)
        {

            $qques=QuizQuestion::Create([
                'quiz_id'=>$quiz->id,
                'question'=>$questions[$i],
                'question_type'=>'Fill In The Gaps',
                'marks'=>$marks[$i]
            ]);


            
        }
        for($i=$quiz->mcq+$quiz->true_false+$quiz->fig; $i<$quiz->mcq+$quiz->true_false+$quiz->fig+$quiz->short_ques ;$i++)
        {

            $qques=QuizQuestion::Create([
                'quiz_id'=>$quiz->id,
                'question'=>$questions[$i],
                'question_type'=>'Short Question',
                'marks'=>$marks[$i]
            ]);


            
        }

    }
}
