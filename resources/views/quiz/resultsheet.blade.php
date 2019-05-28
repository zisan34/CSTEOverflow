@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Result of Quiz: {{$quiz->title}}</strong>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<table class="table">
					<thead>
					<th>Question</th>
					<th>Your answer</th>
					<th>Your Mark</th>
					@if($quiz->show_correct=="1")
					<th>Correct answer</th>
					@endif
					</thead>
					<tbody>
						@foreach($quiz->QuizQuestions as $question)
						<tr>
							<td>{{$question->question}}</td>
							@if($quiz_participation->QuizResult()->count()>0)
								@foreach($quiz_participation->QuizResult()->get() as $result)
									@if($result->quiz_question_id==$question->id)
									<td>
										{{$result->answer}}
									</td>
									<td>
										{{$result->marks}}/{{$question->marks}}
									</td>
									@endif
								@endforeach
							@else
							<td></td>
							<td></td>
							@endif

						@if($quiz->show_correct=="1")
							<td>{{$question->correctAnswer()}}</td>
						@endif
							
						</tr>
						@endforeach
					</tbody>
					<tr>
						<thead>
							<th></th>
							<th>Total:</th>
							<th>{{$quiz_participation->marks}}/{{$quiz->total_marks}}({{($quiz_participation->marks/$quiz->total_marks)*100}}%)</th>
							<th></th>
						</thead>
					</tr>
				</table>
			</div>
			<div class="card-footer">
				@if(!$quiz_participation->evaluation_complete())
				<div class="text-center alert alert-info">*Check back again after your teacher evaluates manually*</div>
				@endif
			</div>
		</div>
		
	</div>
</div>


@endsection