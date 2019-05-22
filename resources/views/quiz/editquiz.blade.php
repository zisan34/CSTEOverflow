@extends('layouts.app')

@section('content')

<!-- Main Content -->
<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Edit Quiz Details</strong>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<form method="post" action="{{ route('onlineExam.update') }}">
					@csrf

					<input type="hidden" value="{{encrypt($quiz->id)}}" name="quiz_id">

					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Quiz Title:</label>
						<div class="col-md-6">
							<input type="" class="form-control" name="title" value="{{$quiz->title}}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Quiz Topic:</label>
						<div class="col-md-6">
							<input type="" class="form-control" name="topic" value="{{$quiz->topic}}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Quiz Total Marks:</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="total_marks" min="1" 
								value="@php
								if(old('total_marks'))
								echo old('total_marks');
								else 
								echo $quiz->total_marks;
								@endphp"  required>
						</div>
					</div>


					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Quize Time Limit:</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="time" min="1" 
								value="{{$quiz->time}}" >
						</div>
					</div>




					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Show Correct answer after Completion?:</label>
						<div class="col-md-6">							
						    <div class="form-control">
						    	<div class="form-check form-check-inline">
						        	<input class="form-check-input" type="radio" name="show_correct" value="0" required 
						        	@if(!$quiz->show_correct) checked @endif>
						        <label class="form-check-label" for="inlineRadio1">No</label>
							    </div>
							    
							    <div class="form-check form-check-inline">
							        <input class="form-check-input" type="radio" name="show_correct" value="1" required 
							        @if($quiz->show_correct) checked @endif>
							        <label class="form-check-label" for="inlineRadio2">Yes</label>
							    </div>
						    </div>

						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Allow Multiple Attempt?:</label>
						<div class="col-md-6">
							<div class="form-control">
								<div class="form-check form-check-inline">
							        <input class="form-check-input" type="radio" name="multiple_attempt" value="0" required 
							        @if(!$quiz->multiple_attempt) checked @endif>
							        <label class="form-check-label" for="inlineRadio1">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input" type="radio" name="multiple_attempt" value="1" required
							        @if($quiz->multiple_attempt) checked @endif>
							        <label class="form-check-label" for="inlineRadio2">Yes</label>
							    </div>
						    </div>

						</div>
					</div>




					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Quiz Secret Key:</label>
						<div class="col-md-6">
							<input type="" class="form-control" name="key" value="{{$quiz->key}}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Quiz Message<small> (optional)</small>:</label>
						<div class="col-md-6">
							<input type="" class="form-control" name="message" value="{{$quiz->message}}">
						</div>
					</div>

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
