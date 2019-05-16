@extends('layouts.app')

@section('content')




<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 mx-auto">


          <a href="{{ route('onlineExam.create') }}" class="btn btn-primary btn-block">Create New Quiz</a>
          <a href="{{ route('onlineExam.participate') }}" class="btn btn-primary btn-block">Participate in Quiz</a>



          <br><br>

        </div>


        <!-- Sidebar Widgets Column -->
        

        @include('inc.sidebar')


      </div>
</div>

<hr>


@endsection


