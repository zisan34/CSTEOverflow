@extends('layouts.app')

@section('content')

<h2>Posts for Tag: <a href="{{ route('posts.filter.tag',['id'=>encrypt($tag->id)]) }}">{{$tag->title}}</a></h2>

<div class="row">
		<div class="col-lg-8 col-md-12">
		@foreach($posts as $post)
		<div class="post-preview">
		  <a href="{{ route('post.view',['slug'=>$post->slug,'id'=>encrypt($post->id)]) }}">
		    <h2 class="post-title">
		      {{$post->title}}
		    </h2>
		  </a>
		  <div class="comment more">
		    {!!$post->content!!} <a href="{{ route('post.view',['slug'=>$post->slug,'id'=>encrypt($post->id)]) }}" style="text-decoration:none; color: blue">See more</a>
		  </div>
		  <p class="post-meta">Posted by
		    <a href="">{{$post->user->name}}</a>
		    {{$post->created_at->toDayDateTimeString()}}</p>
		</div>
		<hr>
		@endforeach
		{{$posts->links()}}
	</div>

	@include('inc.sidebar')
</div>

@endsection