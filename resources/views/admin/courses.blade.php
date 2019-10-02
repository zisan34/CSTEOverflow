@extends('layouts.backend')

@section('content')
<form action="{{ route('add.course') }}" method="post">
    @csrf
    @include('inc.errors')
    <div class="form-group">
        <label for="semester">Select Semester</label>
        <select name="semester" class="form-control">
            <option disabled selected class="text-center">--select semester--</option>
            @foreach ($semesters as $semester)
                <option value="{{$semester->id}}">{{$semester->semester}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">

    <label>Course Title</label>                        
        <input class="form-control" type="text" name="title">
    </div>

    <div class="form-group">

    <label>Course Code</label>                        
        <input class="form-control" type="text" name="code">
    </div>
    <input type="submit" class="btn btn-primary btn-sm" value="Add new Course">
</form>
<br>

<table class="table">
    <thead>
        <th>Semester</th>
        <th>Title</th>
        <th>Course Code</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach($semesters as $semester)
            @foreach($semester->courses as $course)
        <tr>
            <td>{{$semester->semester}}</td>
            <td>{{$course->title}}</td>
            <td>{{$course->code}}</td>
            <td>
                <a href="{{ route('delete.course',['id'=>$course->id]) }}" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection
