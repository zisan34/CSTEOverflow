@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Questions</strong>
				<div class="float-right">
					Time Remaining:
					<span id="counter">
						<span id="minute">{{$quiz->time}}</span>:
						<span id="second">0</span>

					</span>
				</div>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<form method="post" name="timeOut" id="timeOut" action="{{ route('onlineExam.submit') }}">
					@csrf
					<input type="hidden" name="quiz_id" value="{{encrypt($quiz->id)}}">
					
					@if(count($questions)>0)
					@php
						$count=0;
					@endphp

					@foreach($questions as $question)

					<input type="hidden" name="answer[{{$count}}]" value="">			

					@if($question->question_type=='MCQ')
					<label>{{$question->question}}:</label>
						@foreach($question->QQsAnswers->shuffle() as $answer)
						<div class="radio">
						<label><input type="radio" name="answer[{{$count}}]" value="{{$answer->answer}}">{{$answer->answer}}</label>
						</div>
						@endforeach

					@elseif($question->question_type=='True False')
					<label>{{$question->question}}:</label>
					<select class="form-control" name="answer[{{$count}}]">
					<option disabled selected value="">--Select an option--</option>
				    <option value="True">True</option>
				    <option value="False">False</option>
					</select>
					


					@else

					<div class="form-group">
						<label>{{$question->question}}</label>
						@if($question->question_type=='Short Question')
						<input type="text-area" class="form-control" name="answer[{{$count}}]">
						@else
						<input type="text" class="form-control" name="answer[{{$count}}]">
						@endif
					</div>

					@endif

					<hr>

					@php
						$count++;
					@endphp

					@endforeach
					@endif

					<input type="submit" name="end_quiz" class="btn btn-primary" value="End Quiz">



				</form>
			</div>




		</div>
		
	</div>
</div>


@endsection

@section('scripts')

{{-- <script  type="text/javascript">
// $(window).on('popstate', function(event){
// alert("pop");
// });
$( document ).ready(function() {
// 	window.onpopstate = function(event) {
// 	alert("location: " + document.location + ", state: " + JSON.stringify(event.state));
// };

// window.onbeforeunload = function(){
//   return 'Are you sure you want to leave?';
// };


// $(window).bind('beforeunload', function(){
//   return 'Are you to leave?';
// });




function doSomething(){
    //do some stuff here. eg:
	document.getElementById('timeOut').submit();
}
function showADialog(e){
    var confirmationMessage = 'Your message here';
    //some of the older browsers require you to set the return value of the event
    (e || window.event).returnValue = confirmationMessage;     // Gecko and Trident
    return confirmationMessage;                                // Gecko and WebKit
}
window.addEventListener("beforeunload", function (e) {
    // to do something (Remember, redirects or alerts are blocked here by most browsers):
    doSomething();    
    // to show a dialog (uncomment to test):
    return showADialog(e);  
});


});

</script> --}}

<script  type="text/javascript">
window.onload=function(){ 
    window.setTimeout(function(){
		document.getElementById('timeOut').submit();
		}, 1000*<?php echo $quiz->time ?>*60);
};
</script>

<script type="text/javascript">
	var counter=document.getElementById('counter');
	var time=<?php echo $quiz->time ?>*60;
	var my_counter=setInterval(function(){
		minute=Math.floor(time/60);
		second=time%60;
		document.getElementById('minute').innerHTML=minute;
		document.getElementById('second').innerHTML=second;

		time--;
	},1000);
</script>


<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="{{ asset('js/jquery.backDetect.js') }}"></script>
<script>
$( document ).ready(function() {

$(window).load(function(){
	$('body').backDetect(function(event){
		$('#timeOut').submit();
		alert("Sumbiting Result");
	});
});
});
</script>

@endsection
