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
        <div class="col-lg-8 col-md-10 mx-auto text-center">
        	{!!$post->content!!}
        </div>
      </div>
    </div>
    <div class="container-fluid">
    	<div class="text-center">
    		Used Tags: <br>
		  @foreach($post->tags as $tag)
		  	<a href="{{ route('posts.filter.tag',['id'=>encrypt($tag->id)]) }}" class="btn btn-secondary" style="border-radius: 50%">{{$tag->title}}</a>
		  @endforeach
	  	</div>

	</div>
	<div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10">
        	@auth
                <form method="post" action="{{ route('post.comment',['post_id'=>encrypt($post->id)]) }}">
            	    <label></label>

                  @include('inc.errors')
                  @csrf
                    <div class="form-group">
                        <textarea class="form-control" id="comment" name="content" overlay="auto"></textarea>
                    </div>

                    <input type="submit" name="submit" value="comment" class="btn btn-primary">
                </form>

            	<hr>
            @endauth

            @foreach($post->comments as $comment)
	          <div class="post-heading">
	            <span class="meta">
	              <a href="#">{{$comment->user->name}}</a>
	              {{$comment->created_at->diffForHumans()}}
	          	</span>
	          	<div class="card-header card-footer">
	          		{!!$comment->content!!}
	          	</div>
	          </div>
            <hr>
            @endforeach

        </div>
      </div>
    </div>
  </article>


@endsection

@section('links')

<link href="{{asset('summernote/summernote-lite.css')}}" rel="stylesheet">
@endsection

@section('scripts')

<script src="{{asset('summernote/summernote-lite.js')}}"></script>

<script>
$(document).ready(function() {
    $('#comment').summernote({
    tabsize: 2,
    height: 100,

	toolbar: [
	['style', ['style']],
	['font', ['bold', 'underline', 'clear']],
	['fontname', ['fontname']],
	['fontsize', ['fontsize']],
	['color', ['color']],
	['para', ['ul', 'ol', 'paragraph']],
	['table', ['table']],
	['insert', ['link', 'picture']],
	['view', ['fullscreen', 'help']]
	]

    });
});

</script>

@endsection