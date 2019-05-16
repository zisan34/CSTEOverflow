@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Questions</strong>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<form method="post" name="timeOut" id="timeOut" action="{{ route('onlineExam.submit') }}">
					@csrf
					<input type="hidden" name="quiz_id" value="{{encrypt($quiz->id)}}">
					
					@if(count($quiz->QuizQuestions)>0)
					@php
						$count=0;
					@endphp

					@foreach($quiz->QuizQuestions as $question)

					@if($question->question_type=='MCQ')
					<label>{{$question->question}}:</label>
					<input type="hidden" name="answer[{{$count}}]" value="">
						@foreach($question->QQsAnswers as $answer)
						<div class="radio">
						<label><input type="radio" name="answer[{{$count}}]" value="{{$answer->answer}}">{{$answer->answer}}</label>
						</div>
						@endforeach



					@else

					<div class="form-group">
						<label>{{$question->question}}</label>
						<input type="text" class="form-control" name="answer[{{$count}}]">
					</div>

					@endif

					<hr>

					@php
						$count++;
					@endphp

					@endforeach
					@endif

					<input type="submit" name="end_quiz" class="btn btn-primary" value="End Quiz">

					<script  type="text/javascript">
window.onload=function(){ 
    window.setTimeout(function() { document.getElementById('timeOut').submit(); }, 1000*<?php echo $quiz->time ?>*60);
};
</script>

				</form>
			</div>




		</div>
		
	</div>
</div>


@endsection

@section('scripts')

@endsection
