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
</style>



@endsection



<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 mx-auto">
            
            @auth
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
            @endauth

            <hr>
            
            @foreach($posts as $post)
            <div class="post-preview">
              <a href="{{ route('post.view',['slug'=>$post->slug,'id'=>encrypt($post->id)]) }}">
                <h2 class="post-title">
                  {{$post->title}}
                </h2>
              </a>
              <p>
                {!!$post->content!!} <a href="" style="text-decoration:none; color: blue">See more</a>
              </p>
              <p class="post-meta">Posted by
                <a href="">{{$post->user->name}}</a>
                {{$post->created_at->toDayDateTimeString()}}</p>
            </div>
            <hr>
            @endforeach


            <hr>
            <!-- Pager -->
            {{$posts->links()}}

            
        </div>


        <!-- Sidebar Widgets Column -->
        {{-- col-lg-8 col-md-10 mx-auto --}}
        <div class="col-lg-4 col-md-12">

          <br>


            <a href="#" class="btn btn-block btn-info">Publish New Notice</a>

            <a href="#" class="btn btn-block btn-info">Create New Test</a>


            <!-- Search Widget -->
            <div class="card my-4">
              <h5 class="card-header">Search</h5>
              <div class="card-body">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary btn-xs" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
              <h5 class="card-header">Popular Tags</h5>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                      <li>
                        <a href="#">Web Design</a>
                      </li>
                      <li>
                        <a href="#">HTML</a>
                      </li>
                      <li>
                        <a href="#">Freebies</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                      <li>
                        <a href="#">JavaScript</a>
                      </li>
                      <li>
                        <a href="#">CSS</a>
                      </li>
                      <li>
                        <a href="#">Tutorials</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Side Widget -->
            <div class="card my-4">
              <h5 class="card-header">Side Widget</h5>
              <div class="card-body">
                You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
              </div>
            </div>

          </div>

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

@endsection