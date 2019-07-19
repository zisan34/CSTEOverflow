@extends('layouts.backend')

@section('content')
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

				@if($semester->files->count()>0)

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
					            <span>

						            <a href="{{$file->link}}" target="_blank">{{$file->title}}</a>

						        	<a href="{{ route('admin.delete.file',['id'=>$file->id]) }}" class="float-right btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>

					        	</span>


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
				@endif
				@php
					$collapse++;
				@endphp
				@endforeach

			</div>
		</div>
</div>


@endsection
