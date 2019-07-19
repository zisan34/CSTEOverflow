@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 mx-auto">
        	@auth
			<form method="post" action="{{ route('file.save') }}">
			  @include('inc.errors')
			  @csrf
			    <div class="form-group">
			      <label>Title</label>
			      <input type="text" name="title" class="form-control">
			    </div>

			    <div class="form-group">
			      <label>Semester</label>
			      <select name="semester_id" class="form-control">
			      	@foreach($semesters as $semester)
			      	<option value="{{$semester->id}}">{{$semester->semester}}</option>
			      	@endforeach
			      </select>
			    </div>

			    <div class="form-group">
			        <label>File Link:</label>
			        <input type="url" name="link" class="form-control">
			    </div>
			    <input type="submit" name="submit" value="Publish" class="btn btn-primary">
			</form>
			@endauth
			<br>
			<div class="card">
				<div class="card-header">All Files</div>
					<div class="body">
						<div id="accordion">
							@php
								$collapse=1;
							@endphp
							@foreach($semesters as $semester)

							<div class="card">
								<div class="card-header" id="headingTwo">
								  <h5 class="mb-0">
								    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$collapse}}" aria-expanded="false" aria-controls="collapseTwo">
								      {{$semester->semester}}
								    </button>								    
								    <button class="btn btn-link collapsed float-right" data-toggle="collapse" data-target="#collapse{{$collapse}}" aria-expanded="false" aria-controls="collapseTwo" style="text-decoration: none;">
								      <strong>+</strong>
								    </button>
								  </h5>
								</div>
								<div id="collapse{{$collapse}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								  <div class="card-body">
								    <ul>
								        @foreach($semester->files as $file)
								        <li>				                	
								            <p><a href="{{$file->link}}" target="_blank">{{$file->title}}</a></p>

								          	<p class="post-meta">
								          		<small>Posted by
								                <a href="">{{$file->user->name}}</a>
								                {{$file->created_at->toDayDateTimeString()}}
								        		</small>
								        	</p>
								        </li>
								        @endforeach
								    </ul>
								  </div>
								</div>
							</div>
							@php
								$collapse++;
							@endphp
							@endforeach

						</div>
					</div>
			</div>
		</div>

		@include('inc.sidebar')
	</div>
</div>


@endsection
