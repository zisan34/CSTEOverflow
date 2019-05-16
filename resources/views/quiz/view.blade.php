@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Enter Question Details</strong>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<form method="post" action="">
					@csrf
					<input type="hidden" name="quiz_id" value="{{$quiz->id}}">
					
					@if(count($quiz->QuizQuestions)>0)

					@foreach($quiz->QuizQuestions as $question)

					@if($question->question_type=='MCQ')
					
					<label>{{$question->question}}:</label>
						<div>
						@foreach($question->QQsAnswers as $answer)
						<div class="radio">
						<label><input type="radio" name="" value="{{$answer->answer}}">{{$answer->answer}}</label>
						</div>
						@endforeach
						</div>



					@else

					<div class="form-group">
						<label>{{$question->question}}</label>
						<input type="text" class="form-control" name="">
					</div>

					@endif

					<hr>

					@endforeach
					@endif

				</form>
			</div>
		</div>
		
	</div>
</div>


@endsection