@extends('layouts.app')

@section('content')



@section('links')
<!-- include summernote css/js -->

<link href="{{asset('summernote/summernote-lite.css')}}" rel="stylesheet">


@endsection



<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 mx-auto">
            
            @auth
                <form>
                    <div class="form-group">
                        <label>Let's Discuss:</label>
                        <textarea class="form-control" id="post_details" name="post_details" placeholder="What's being Overflowed?" overlay="auto"></textarea>
                    </div>
                    <a class="btn btn-primary" href="">Post</a>
                </form>
            @endauth

            <hr>

            <div class="post-preview">
              <a href="post.html">
                <h2 class="post-title">
                  Man must explore, and this is exploration at its greatest
                </h2>
                <h3 class="post-subtitle">
                  Problems look mighty small from 150 miles up
                </h3>
              </a>
              <p class="post-meta">Posted by
                <a href="#">Start Bootstrap</a>
                on September 24, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
              <a href="post.html">
                <h2 class="post-title">
                  I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.
                </h2>
              </a>
              <p class="post-meta">Posted by
                <a href="#">Start Bootstrap</a>
                on September 18, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
              <a href="post.html">
                <h2 class="post-title">
                  Science has not yet mastered prophecy
                </h2>
                <h3 class="post-subtitle">
                  We predict too much for the next year and yet far too little for the next ten.
                </h3>
              </a>
              <p class="post-meta">Posted by
                <a href="#">Start Bootstrap</a>
                on August 24, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
              <a href="post.html">
                <h2 class="post-title">
                  Failure is not an option
                </h2>
                <h3 class="post-subtitle">
                  Many say exploration is part of our destiny, but it’s actually our duty to future generations.
                </h3>
              </a>
              <p class="post-meta">Posted by
                <a href="#">Start Bootstrap</a>
                on July 8, 2019</p>
            </div>
            <hr>
            <!-- Pager -->
            <div class="clearfix">
              <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>

        <br><br>
            </div>
        </div>


        <!-- Sidebar Widgets Column -->
        {{-- col-lg-8 col-md-10 mx-auto --}}
        <br>
        <div class="col-lg-4 col-md-12">


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
              <h5 class="card-header">Categories</h5>
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

@endsection