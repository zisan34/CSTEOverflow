@extends('layouts.app')

@section('content')




<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 mx-auto">


          <a href="{{ route('onlineExam.create') }}" class="btn btn-primary btn-block">Create New Quiz</a>
          <a href="{{ route('onlineExam.participate') }}" class="btn btn-primary btn-block">Participate in Quiz</a>
<br>
		{{-- @if(Auth::user()->type=="Teacher") --}}
          <div class="card">
          	<div class="card-header">Previously Created Quizes:</div>
          	<div class="card-body">
          		<table class="table">
          			<thead>
          				<th>Title</th>
          				<th>Topic</th>
          				<th>Participants</th>
          				<th>Status</th>
          			</thead>
          			<tbody>
          			@foreach($quizzes as $quiz)
          			<tr>
          				<td><a href="{{ route('onlineExam.view',['id'=>$quiz->id]) }}">{{$quiz->title}}</a></td>
          				<td>{{$quiz->topic}}</td>
          				<td>{{$quiz->QuizParticipation()->count()}} <a href="{{ route('onlineExam.participations',['id'=>$quiz->id]) }}" class="btn btn-sm btn-info">View</a></td>
          				<td>@if($quiz->enabled)
          					enabled
          					@else
          					disabled
          					@endif
          				</td>

          			</tr>
          			@endforeach
          			</tbody>
          		</table>
          	</div>
          </div>
          {{-- @endif --}}
        <div class="card">
          	<div class="card-header">Previously Participated Quizes:</div>
          	<div class="card-body">
          		<table class="table">
          			<thead>
          				<th>Title</th>
          				<th>Topic</th>
          				<th>Marks</th>
          			</thead>
          			<tbody>
          			@foreach(Auth::user()->QuizParticipation->sortByDesc('created_at') as $quiz_participation)
          			<tr>
          				<td><a href="{{route('onlineExam.result',['$quiz_participation_id'=>Crypt::encrypt($quiz_participation->id)])}}">{{$quiz_participation->Quiz->title}}</a></td>
          				<td>{{$quiz_participation->Quiz->topic}}</td>
          				<td>{{$quiz_participation->marks}}</td>
          			</tr>
          			@endforeach
          			</tbody>
          		</table>
          	</div>
         </div>



          <br><br>

        </div>


        <!-- Sidebar Widgets Column -->
        

        @include('inc.sidebar')


      </div>
</div>

<hr>


@endsection


