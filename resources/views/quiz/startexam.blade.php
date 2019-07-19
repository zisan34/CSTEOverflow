@extends('layouts.app')
@section('links')

<style type="text/css">
	body:fullscreen {
  overflow: scroll !important;
}
body:-ms-fullscreen {
  overflow: scroll !important;
}
body:-webkit-full-screen {
  overflow: scroll !important;
}
body:-moz-full-screen {
  overflow: scroll !important;
}
</style>

@endsection
@section('content')

<div class="container" id="container" onclick="openFullscreen();">
	<div class="col-md-12">
	<div class="alert alert-danger">Don't try to minimize or change tabs. Otherwise your Answer sheet will be auto submitted.</div>
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

					<div class="questions">

					@foreach($questions as $question)


					<div id="ques{{$count+1}}">
					<p class="text-center">Question:{{$count+1}}/{{count($questions)}}</p>
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

					</div>
					@endforeach					
					<button type="button" name="prev" class="btn btn-sm btn-info">previous question</button>
					<button type="button" name="next" class="btn btn-sm btn-info float-right">next question</button>
					</div>
					<br>
					<hr>
					@endif

					<div class="text-center">
					<input type="submit" name="end_quiz" class="btn btn-danger text-center" value="End Quiz">
					</div>



				</form>
			</div>



			<div id="accordion">
				@php
					$collapse=1;
				@endphp

				<div class="card">
					<div class="card-header" id="headingTwo">
					  <h5 class="mb-0">
					    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$collapse}}" aria-expanded="false" aria-controls="collapseTwo">
					      Questions:
					    </button>								    
					    <button class="btn btn-link collapsed float-right" data-toggle="collapse" data-target="#collapse{{$collapse}}" aria-expanded="false" aria-controls="collapseTwo" style="text-decoration: none;">
					      <strong>+</strong>
					    </button>
					  </h5>
					</div>
					<div id="collapse{{$collapse}}" class="collapse text-center" aria-labelledby="headingTwo" data-parent="#accordion">
				    	@php
				    		$que_no=1;
				    	@endphp
				        @foreach($questions as $question) 	
				            <a href="#" onclick="showQues({{$que_no}})">{{$que_no}}.{{$question->question}}</a><br>
				        @php
				        	$que_no++;
				        @endphp
				        @endforeach
					</div>
				</div>
				@php
					$collapse++;
				@endphp

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


	$(window).blur(function(){
		$('#timeOut').submit();
	});
});
});
</script>
{{-- previous next button --}}
<script>
	function showQues(now){
    var divs = $('.questions>div');
	    divs.hide();
	    divs.eq(now-1).show();
    }
	$(document).ready(function() {
    var divs = $('.questions>div');
    var now = 0; // currently shown div
    divs.hide().first().show(); // hide all divs except first
    $("button[name=next]").click(function() {
        divs.eq(now).hide();
        now = (now + 1 < divs.length) ? now + 1 : 0;
        divs.eq(now).show(); // show next
    });
    $("button[name=prev]").click(function() {
        divs.eq(now).hide();
        now = (now > 0) ? now - 1 : divs.length - 1;
        divs.eq(now).show(); // show previous
    });


});
</script>

<script type="text/javascript">

  function openFullscreen() {
	var elem = document.documentElement;
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
    } else if (elem.mozRequestFullScreen) { /* Firefox */
      elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
      elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE/Edge */
      elem.msRequestFullscreen();
    }
  }

</script>


@endsection
