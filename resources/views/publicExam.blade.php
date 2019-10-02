@extends('layouts.app')

@section('content')




<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 mx-auto">

          @auth
          @if(Auth::user()->student())

          <div class="card">
            <div class="card-header">Select Course</div>
            <div class="card-body">
              <ul>

              @foreach($courses as $course)

              @if(count($course->questions)>0)
                <li>
              <a href="{{ route('publicExam.start',['id'=>encrypt($course->id)]) }}">{{$course->title}}</a>
                </li>

              @endif

              @endforeach
              </ul>
              

              @endif
            </div>
          </div>


          <br>



           @endauth



          <br><br>

        </div>


        <!-- Sidebar Widgets Column -->
        

        @include('inc.sidebar')


      </div>
</div>

<hr>


@endsection


