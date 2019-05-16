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
				<table class="table">
					<thead>
					<th>Question</th>
					<th>Your answer</th>
					<th>Your Mark</th>
					<th>Correct answer</th>
					</thead>
					<tbody>
						@foreach($quiz->QuizQuestions as $question)
						<tr>
							<td>{{$question->question}}</td>
							@foreach($quiz_participation->QuizResult()->get() as $result)
								@if($result->quiz_question_id==$question->id)
								<td>
									{{$result->answer}}
								</td>
								<td>
									{{$result->marks}}
								</td>
								@endif
							@endforeach

							<td>{{$question->correctAnswer()}}</td>
							
						</tr>
						@endforeach
					</tbody>
					<tr>
						<thead>
							<th></th>
							<th>Total:</th>
							<th>{{$quiz_participation->marks}}</th>
							<th></th>
						</thead>
					</tr>
				</table>
			</div>
		</div>
		
	</div>
</div>


@endsection