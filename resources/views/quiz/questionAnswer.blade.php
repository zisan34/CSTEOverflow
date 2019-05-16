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
				<form method="post" action="{{ route('onlineExam.create.questionAnswer') }}">
					@csrf
					<input type="hidden" name="quiz_id" value="{{$quiz_id}}">
					
					@php
						$count=0;
					@endphp
					@if($mcqs>0)
						@while($mcqs--)
							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Question {{$count+1}}:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="questions[]" value="{{old('questions.'.$count)}}">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Marks:</label>
								<div class="col-md-6">
									<input type="number" class="form-control" name="marks[]" 
								value="@php
								if(old('marks[]'))
								echo old('marks[]');
								else 
								echo "1";
								@endphp" min="1">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Correct Answer of Question {{$count+1}}:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="answers[{{$count}}][]" value="{{old('answers.' . $count . '.0')}}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Option 2</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="answers[{{$count}}][]" value="{{old('answers.'.$count.'.1')}}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Option 3</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="answers[{{$count}}][]" value="{{old('answers.'.$count.'.2')}}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Option 4</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="answers[{{$count}}][]" value="{{old('answers.'.$count.'.3')}}">
								</div>
							</div>
							<hr>
							@php
								$count++;
							@endphp
						@endwhile
					@endif
					@if($figs>0)
						@while($figs--)
							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Question {{$count+1}}:</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="questions[]" value="{{old('questions.'.$count)}}">
								</div>
							</div>							
							<div class="form-group row">
								<label class="col-md-6 col-form-label text-center">Marks:</label>
								<div class="col-md-6">
									<input type="number" class="form-control" name="marks[]" 
								value="@php
								if(old('marks[]'))
								echo old('marks[]');
								else 
								echo "1";
								@endphp" min="1">
								</div>
							</div>
							@php
								$count++;
							@endphp
							<hr>
						@endwhile

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