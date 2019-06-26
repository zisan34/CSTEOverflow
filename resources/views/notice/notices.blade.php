@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 mx-auto">
        	@auth
        	@if(Auth::user()->office_stuff())
			<form method="post" action="{{ route('notice.save') }}" enctype="multipart/form-data">
			  @include('inc.errors')
			  @csrf
			    <div class="form-group">
			      <label>Title</label>
			      <input type="text" name="title" class="form-control">
			    </div>
			    <div class="form-group">
			    	<label>Type</label>
			    	<select class="form-control" name="type">
						<option disabled selected value="">--Select an option--</option>
			    		<option>Result</option>
			    		<option>Vacation</option>
			    		<option>Sports</option>
			    		<option>Exam</option>
			    		<option>Seminar</option>
			    		<option>Miscellaneous</option>

			    	</select>
			    </div>
			    <div class="form-group">
			        <label>File:</label>
			        <input type="file" name="content">
			    </div>
			    <div class="form-group">
			    	<label>Comments(Optional)</label>
			    	<input type="text" name="comment" class="form-control" >
			    </div>

			    <input type="submit" name="submit" value="Publish" class="btn btn-primary">
			</form>
			@endif
			@endauth
			<br>
			<div class="card">
				<div class="card-header">All Notices</div>
					<div class="body">
						<div class="container">
				            @foreach($notices as $notice)
				            <div class="post-preview">
				              <a href="{{ route('notice.view',['id'=>encrypt($notice->id)]) }}">
				                <h2 class="post-title">
				                  {{$notice->title}}
				                </h2>
				              </a>
				              <p class="post-meta">Posted by
				                <a href="">{{$notice->user->name}}</a>
				                {{$notice->created_at->toDayDateTimeString()}}</p>
				            </div>
				            <hr>
				            @endforeach
						</div>
					</div>
			</div>
		</div>

		@include('inc.sidebar')
	</div>
</div>


@endsection
