@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<strong>Enter Exam Details</strong>
			</div>
			<div class="card-body">
				@include('inc.errors')
				<form method="post" action="{{ route('onlineExam.quiz_info') }}">
					@csrf
					<div class="form-group">
						<label>Quiz Id</label>
						<input type="number" name="quiz_id" class="form-control">
					</div>
					<div class="form-group">
						<label>Secret Key</label>
						<input type="text" name="secret_key" class="form-control">
					</div>
					<input class="btn btn-primary" type="submit" name="submit" value="Submit">

				</form>
			</div>
		</div>
		
	</div>
</div>


@endsection