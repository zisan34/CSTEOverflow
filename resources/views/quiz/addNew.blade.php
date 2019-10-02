@extends('layouts.app')

@section('content')

<!-- Main Content -->
<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Enter new question details</strong>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<form method="post" action="{{ route('onlineExam.create.setQuestionAnswer') }}">
					@csrf

					<input type="hidden" name="quiz_id" value="{{encrypt($quiz->id)}}">
					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Number Of New MCQ:</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="mcq" min="0" 
								value="@php
								if(old('mcq'))
								echo old('mcq');
								else 
								echo "1";
								@endphp" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Number Of New True False:</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="true_false" min="0" 
								value="@php
								if(old('mcq'))
								echo old('mcq');
								else 
								echo "1";
								@endphp" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Number of New Fill in the gaps:</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="fig" min="0" 
								value="@php
								if(old('mcq'))
								echo old('mcq');
								else 
								echo "1";
								@endphp" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-6 col-form-label text-center">Number of New Short Questions:</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="short_ques" min="0" 
								value="@php
								if(old('short_ques'))
								echo old('short_ques');
								else 
								echo "1";
								@endphp" >
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
