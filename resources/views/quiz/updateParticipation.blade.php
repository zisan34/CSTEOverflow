@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
	<div class="card-header">
		Answer Sheet of: {{$participation->user->name}}

		<div class="float-right">
			<a href="{{ route('onlineExam.participations',['id'=>$participation->Quiz->id]) }}" class="btn btn-sm btn-primary">Back</a>
		</div>
	</div>
	<div class="card-body">
		@include('inc.errors')		
		<table class="table">
			<thead>
				<th>Question</th>
				<th>Participant's answer</th>
				<th>Mark</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach($participation->QuizResult as $result)
				<tr>
					<td>{{$result->QuizQuestion->question}}</td>
					<td>{{$result->answer}}</td>
					<td>{{$result->marks}}</td>
					<td>
						@if($result->QuizQuestion->question_type=="Fill In The Gaps")
							@if(!$result->marks)
								<a href="{{ route('onlineExam.participation.updateFIGresult',['id'=>encrypt($result->id),'status'=>1]) }}" class="btn btn-sm btn-success">Correct</a>
								<a href="{{ route('onlineExam.participation.updateFIGresult',['id'=>encrypt($result->id),'status'=>0]) }}" class="btn btn-sm btn-danger">Incorrect</a>
							@endif
						@elseif($result->QuizQuestion->question_type=="Short Question")
							<form action="{{ route('onlineExam.participation.updateSQresult') }}" method="post">
								@csrf
								<input type="hidden" name="id" value="{{encrypt($result->id)}}">
								<input type="number" name="marks" value="{{$result->marks}}" max="{{$result->QuizQuestion->marks}}" min="0">/{{$result->QuizQuestion->marks}}
								<input type="submit" value="Save" class="btn btn-sm btn-primary">
							</form>

						@else
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		@if($participation->previous_id())
		<a href="{{ route('onlineExam.participation.manual',['id'=>$participation->previous_id()]) }}" class="btn btn-sm btn-primary">Previous</a>
		@endif
		@if($participation->next_id())
		<a href="{{ route('onlineExam.participation.manual',['id'=>$participation->next_id()]) }}" class="btn btn-sm btn-primary float-right">Next</a>
		@endif
	</div>
</div>
</div>
@endsection