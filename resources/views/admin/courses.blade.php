@extends('layouts.backend')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel  panel-default">
                <div class="panel-heading">Courses</div>

                <div class="panel-body">
                    @include('inc.errors')
                    <form action="{{ route('add.course') }}" method="post">
                        @csrf
                        <div class="form-group">

                        <label>Course Title</label>                        
                            <input class="form-control" type="text" name="title">
                        </div>

                        <div class="form-group">

                        <label>Course Code</label>                        
                            <input class="form-control" type="text" name="code" placeholder="*optional*">
                        </div>
                        <input type="submit" class="btn btn-primary btn-sm" value="Add new Course">
                    </form>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>Courses</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                            <td>{{$course->title}}</td>
                            <td>
                                <a href="{{ route('delete.course',['id'=>$course->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
