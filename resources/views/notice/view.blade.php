@extends('layouts.app')

@section('content')


<div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{$notice->title}}</h1>
            <span class="meta">Posted by
              <a href="#">{{$notice->user->name}}</a>
              {{$notice->created_at->toDayDateTimeString()}}</span>
          </div>
          <hr>
        </div>
    </div>
</div>


  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto text-center">
        	{{-- <embed src="https://drive.google.com/viewerng/viewer?embedded=true&url={{ asset($notice->content) }}" width="500" height="375"> --}}
          {{-- <embed src="{{ asset($notice->content) }}" type="application/pdf" width="100%" height="600px" /> --}}
          {{-- <object width="400" height="400" data="{{ asset($notice->content) }}"></object> --}}
          {{-- <iframe src="http://docs.google.com/gview?url={{ asset($notice->content) }}&embedded=true" style="width:718px; height:700px;" frameborder="0"></iframe> --}}
          <iframe src="http://docs.google.com/gview?url=https://nstu.edu.bd/uploads/career/1557054725-Teacher's%20Advertisement%202%20April%202019.pdf&amp;embedded=true" style="width:100%; height:700px;" frameborder="0" ></iframe>
          {{-- <embed src="{{ asset($notice->content) }}" type="application/pdf" width="100%" height="600px" /> --}}
          
          <h3 class="text-center">Or</h3>

          <a class="btn btn-info text-center" href="https://nstu.edu.bd/uploads/career/1557054725-Teacher's%20Advertisement%202%20April%202019.pdf" download>Download</a>


        </div>
      </div>
    </div>
  </article>


@endsection