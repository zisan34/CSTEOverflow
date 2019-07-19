@extends('layouts.app')

@section('content')



@section('links')
<!-- include summernote css/js -->

<link href="{{asset('summernote/summernote-lite.css')}}" rel="stylesheet">
<link href="{{ asset('bootstrap-multiselect/bootstrap-multiselect.css') }}" rel="stylesheet">

<style>
  .dropdown-menu {
    z-index: 2000;
  }

/*a {
  color: #0254EB
}
a:visited {
  color: #0254EB
}
a.morelink {
  text-decoration:none;
  outline: none;
}
.morecontent span {
  display: none;
}
.comment {
  width: 400px;
  background-color: #fff;
  margin: 10px;
}*/
</style>



@endsection



<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 mx-auto">
            
            @auth
                @if(!Auth::user()->office_stuff())
                
                <form method="post" action="{{ route('post.save') }}">
                  @include('inc.errors')
                  @csrf
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Details:</label>
                        <textarea class="form-control" id="post_details" name="content" placeholder="What's being Overflowed?" overlay="auto"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Tags:</label>
                      <select id="example-getting-started" multiple="multiple" name="tags[]" >
                        @foreach($tags as $tag)
                          <option value="{{$tag->id}}" >{{$tag->title}}</option>

                        @endforeach
                      </select>
                    </div>

                    <input type="submit" name="submit" value="Post" class="btn btn-primary">
                </form>

                <hr>

                @endif
            @endauth

            
            @foreach($posts as $post)
            <div class="post-preview">
              <a href="{{ route('post.view',['id'=>encrypt($post->id)]) }}">
                <h2 class="post-title">
                  {{$post->title}}
                </h2>
              </a>
{{--               <div class="comment more">
                {!!$post->content!!} <a href="{{ route('post.view',['slug'=>$post->slug,'id'=>encrypt($post->id)]) }}" style="text-decoration:none; color: blue">See more</a>
              </div> --}}
              <p class="post-meta">Posted by
                <a href="">{{$post->user->name}}</a>
                {{$post->created_at->toDayDateTimeString()}}</p>
            </div>
            <hr>
            @endforeach


            <hr>
            <!-- Pager -->
            @if($posts->links())
            {{$posts->links()}}
            @endif

            
        </div>


        <!-- Sidebar Widgets Column -->
        {{-- col-lg-8 col-md-10 mx-auto --}}
@include('inc.sidebar')

      </div>
</div>

<hr>


@endsection

@section('scripts')

{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> --}}
<script src="{{asset('summernote/summernote-lite.js')}}"></script>

<script src=" {{ asset('bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>

<script>
$(document).ready(function() {
    $('#post_details').summernote({
    placeholder: 'What\'s being Overflowed?',
    tabsize: 2,
    height: 100,
    // toolbar: [
  //   // [groupName, [list of button]]
     //    ['style', ['bold', 'italic', 'underline', 'clear']],
     //    ['font', ['strikethrough', 'superscript', 'subscript']],
     //    ['fontsize', ['fontsize']],
     //    ['color', ['color']],
     //    ['para', ['ul', 'ol', 'paragraph']],
     //    ['height', ['height']],
     //    ['table'],
     //    ['undo'],
     //    ['redo'],
     //    ['codeview']
     //  ]
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect({
            includeSelectAllOption: true,
            selectAllValue: 'select-all-value'
        });
    });
</script>

{{-- see more button --}}
{{-- <script>
  $(document).ready(function() {
  var showChar = 100;
  var ellipsestext = "...";
  var moretext = "more";
  var lesstext = "less";
  $('.more').each(function() {
    var content = $(this).html();

    if(content.length > showChar) {

      var c = content.substr(0, showChar);
      var h = content.substr(showChar-1, content.length - showChar);

      var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

      $(this).html(html);
    }

  });

  $(".morelink").click(function(){
    if($(this).hasClass("less")) {
      $(this).removeClass("less");
      $(this).html(moretext);
    } else {
      $(this).addClass("less");
      $(this).html(lesstext);
    }
    $(this).parent().prev().toggle();
    $(this).prev().toggle();
    return false;
  });
});
</script> --}}

@endsection