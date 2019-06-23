@extends('layouts.app')

@section('content')


<div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{$post->title}}</h1>
            <span class="meta">Posted by
              <a href="#">{{$post->user->name}}</a>
              {{$post->created_at->toDayDateTimeString()}}</span>
          </div>
          <hr>
        </div>
    </div>
</div>


  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        	{!!$post->content!!}
        </div>
      </div>
    </div>
    <div class="container">
	  @foreach($post->tags as $tag)
	  	<a href="">{{$tag->title}}</a>
	  @endforeach

	</div>
  </article>


@endsection