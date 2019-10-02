@extends('layouts.app')

@section('links')
<!-- include summernote css/js -->

<link href="{{asset('summernote/summernote-lite.css')}}" rel="stylesheet">

@endsection

@section('content')


<div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

          @include('inc.errors')

                <form method="post" action="{{ route('post.update') }}">
                  @include('inc.errors')
                  @csrf
                  <input type="hidden" value="{{encrypt($post->id)}}" name="post_id">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="title" class="form-control" value="{{$post->title}}">
                    </div>
                    <div class="form-group">
                        <label>Details:</label>
                        <textarea class="form-control" id="post_details" name="content" overlay="auto">{!!$post->content!!}</textarea>
                    </div>
                    <div class="form-group">
                      <label>Tags:</label>
                      @foreach($tags as $tag)
                      <input type="checkbox" name="tags[]" value="{{$tag->id}}"
                          @foreach($post->tags as $t)
                            @if($tag->id==$t->id)
                            checked
                            @endif 
                          @endforeach>{{$tag->title}}                          
                        @endforeach
                      </select>
                    </div>

                    <input type="submit" name="submit" value="Update" class="btn btn-success">
                </form>
        </div>
    </div>
</div>


        	



@endsection

@section('links')

<link href="{{asset('summernote/summernote-lite.css')}}" rel="stylesheet">
@endsection

@section('scripts')

<script src="{{asset('summernote/summernote-lite.js')}}"></script>

<script>
$(document).ready(function() {
    $('#post_details').summernote({
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