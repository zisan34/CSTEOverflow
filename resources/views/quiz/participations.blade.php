@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card">
	<div class="card-header">
		Participations of Quiz: {{$quiz->title}}
		<a href="{{ route('onlineExam') }}" class="btn btn-primary btn-sm  float-right">Back</a>
	</div>
	<div class="card-body">
		<table class="table">
			<thead>
				<th>Participant's name</th>
				<th>Obtained Marks</th>
				<th>Action</th>
				<th>Evaluation Status</th>
			</thead>
			<tbody>
				@foreach($quiz->QuizParticipation as $participation)
				<tr>
					<td>{{$participation->user->name}}</td>
					<td>{{$participation->marks}}/{{$quiz->total_marks}}</td>
					<td> <a href="{{ route('onlineExam.participation.manual',['id'=>$participation->id]) }}" class="btn btn-sm btn-info">Manual Check</a></td>
					<td>
						@if($participation->evaluation_complete())
							Complete
						@else
							Incomplete
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
</div>
@endsection