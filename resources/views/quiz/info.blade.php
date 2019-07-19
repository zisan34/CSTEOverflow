@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Quiz Details</strong>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<form method="post" action="{{ route('onlineExam.start') }}">
					@csrf

					<input type="hidden" name="quiz_id" value="{{encrypt($quiz->id)}}">

					<div class="form-group">
						<label>Creator:</label>
						{{$quiz->user->name}}
					</div>

					<div class="form-group">
						<label>Title:</label>
						{{$quiz->title}}
					</div>

					<div class="form-group">
						<label>Total Topics:</label>
						{{$quiz->topic}}
					</div>

					<div class="form-group">
						<label>Total Questions:</label>
						{{$quiz->QuizQuestions->count()}}
					</div>
					<div class="form-group">
						<label>Total Marks:</label>
						{{$quiz->total_marks}}
					</div>
					<div class="form-group">
						<label>Time:</label>
						{{$quiz->time}} Minutes
					</div>
					<div class="form-group">
						<label>Multiple attempt:</label>
						@if($quiz->multiple_attempt=="1")
							<span class="text-success">Allowed</span>
						@else
							<span class="text-danger">Not Allowed</span>
						@endif
					</div>

					@if($quiz->message)
					<div class="form-group">
						<label>Message From Quiz Creator:</label>
						{{$quiz->message}}
					</div>
					@endif

					<input type="submit" name="submit" class="btn btn-primary" value="Start Exam">

				</form>
			</div>
		</div>
		
	</div>
</div>


@endsection

