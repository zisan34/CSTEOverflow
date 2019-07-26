@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Question Details</strong>
				<a href="{{ route('onlineExam') }}" class="float-right btn btn-primary">Back</a>
				
			</div>
			<div class="card-body">
				<div class="form-group text-center">
					<label>Quiz Title: {{$quiz->title}}</label><br>
					<label>Quiz ID: {{$quiz->id}}</label><br>
					<label>Quiz Topic: {{$quiz->topic}}</label><br>
					<label>Quiz Key: {{$quiz->key}}</label><br>
					<label>Quiz Time Limit: {{$quiz->time}} minute<span>@if($quiz->time>"1")s @endif</span></label><br>
					@if($quiz->message)
					<label>Quiz Message: {{$quiz->message}}</label>
					<br>
					@endif

					@if($quiz->enabled)
					<a href="{{ route('onlineExam.disable',['id'=>$quiz->id]) }}" class="btn btn-danger">Disable</a>
					<br><br>
					<div class="alert alert-info text-center">**Share Quiz Id and Quiz Secret Key with your students to participate in the quiz**</div>
					@else
					<a href="{{ route('onlineExam.enable',['id'=>$quiz->id]) }}" class="btn btn-success">Enable</a>
					@endif
				</div>
				<hr>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<form method="post" action="">
					@csrf
					<input type="hidden" name="quiz_id" value="{{$quiz->id}}">
					
					@if(count($quiz->QuizQuestions)>0)

					@foreach($quiz->QuizQuestions as $question)

					@if($question->question_type=='MCQ')
					
					<label>{{$question->question}}</label>
						<div>
						@foreach($question->QQsAnswers as $answer)
						<div class="radio">
						<label><input type="radio" name="" value="{{$answer->answer}}">{{$answer->answer}}</label>
						</div>
						@endforeach
						</div>



					@elseif($question->question_type=='True False')
					
					<label>{{$question->question}}</label>
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
			<div class="card-footer text-center">
				<a href="{{ route('onlineExam.edit',['id'=>encrypt($quiz->id)]) }}" class="btn btn-primary float-left">Edit</a>
				<a href="{{ route('onlineExam.delete',['id'=>encrypt($quiz->id)]) }}" class="btn btn-danger float-right">Delete</a>

			</div>
		</div>
		
	</div>
</div>


@endsection