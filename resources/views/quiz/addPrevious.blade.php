@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Select From Previous Questions:</strong>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<form method="post" action="{{ route('onlineExam.create.addPreQue') }}">
					@csrf
					<input type="hidden" name="quiz_id" value="{{Crypt::encrypt($quiz->id)}}">
					
					@foreach($course->quizzes as $quiz)
					
						@if($quiz->user==Auth::user())
						
							@foreach ($quiz->QuizQuestions as $question) 
								<div class="checkbox">
									<input type="checkbox" name="questions[]" value="{{Crypt::encrypt($question->id)}}">
									<label>{{$question->question}}(<strong>{{$question->question_type}})</strong></label>
									@if($question->question_type=="MCQ"&&$question->QQsAnswers)
									<ul>
										@foreach($question->QQsAnswers as $answer)
											<li>{{$answer->answer}}</li>
										@endforeach
									</ul>
									@endif
								</div>
							@endforeach
						@endif
					@endforeach

					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center"></label>
						<div class="col-md-6">
							<input type="submit" class="btn btn-primary btn-block" value="Next Step">
						</div>
					</div>



				</form>
			</div>
		</div>
		
	</div>
</div>


@endsection