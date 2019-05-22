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
				<form method="post" action="{{ route('onlineExam.update.QA') }}">
					@csrf
					<input type="hidden" name="quiz_id" value="{{$quiz->id}}">

					@if(count($quiz->QuizQuestions)>0)
						@php
							$count=0;
						@endphp

						@foreach($quiz->QuizQuestions as $question)



						@if($question->question_type=='MCQ')

							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Question {{$count+1}}:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="questions[]" 
									value="{{ old('questions.'.$count) ?? $question->question }}"  required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Marks:</label>
								<div class="col-md-6">
									<input type="number" class="form-control" name="marks[]" value="{{$question->marks}}" min="1" required>
								</div>
							</div>

								@php
									$ans_count=0;
								@endphp
							
							@foreach($question->QQsAnswers as $answer)

								@if($ans_count==0)
								<div class="form-group row">
									<label class="col-md-6 col-form-label text-center">Correct Answer of Question {{$count+1}}:</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="answers[{{$count}}][]" value="{{-- {{$answer->answer}} --}}{{ old('answers.'.$count.'.'.$ans_count)??$answer->answer}}" required>

									</div>
								</div>
								@else
								<div class="form-group row">
									<label class="col-md-6 col-form-label text-center">Option {{$ans_count+1}}</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="answers[{{$count}}][]" value="{{old('answers.'.$count.'.'.$ans_count)??$answer->answer}}" required>
									</div>
								</div>
								@endif
								@php
									$ans_count++;
								@endphp

							@endforeach

						@elseif($question->question_type=='True False')

							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Question {{$count+1}}:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="questions[]" 
									value="{{ old('questions.'.$count) ?? $question->question }}"  required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Marks:</label>
								<div class="col-md-6">
									<input type="number" class="form-control" name="marks[]" value="{{$question->marks}}" min="1" required>
								</div>
							</div>

								@php
									$ans_count=0;
								@endphp
							
							@foreach($question->QQsAnswers as $answer)

								@if($ans_count==0)
								<div class="form-group row">
									<label class="col-md-6 col-form-label text-center">Correct Answer of Question {{$count+1}}:</label>
									<div class="col-md-6">
										<select class="form-control" name="answers[{{$count}}][]">
									    <option value="True">True</option>
									    <option value="False">False</option>
									</select>
									</div>
								</div>
								@else
								<div class="form-group row">
									<label class="col-md-6 col-form-label text-center">Option {{$ans_count+1}}</label>

								</div>
								@endif
								@php
									$ans_count++;
								@endphp

							@endforeach

						@else
							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Question {{$count+1}}:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="questions[]" value="{{ old('questions.'.$count) ?? $question->question }}" required>
								</div>
							</div>							
							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Marks:</label>
								<div class="col-md-6">
									<input type="number" class="form-control" name="marks[]" 
								value="{{$question->marks}}" min="1" required>
								</div>
							</div>
							@endif

							<hr>

							@php
								$count++;
							@endphp

							@endforeach
					@endif
					
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