@extends('layouts.backend')

@section('content')
<div class="card card-default">
    <div class="card-header">Tags</div>

    <div class="card-body">
        @include('inc.errors')
        <form action="{{ route('add.tag') }}" method="post">
            @csrf
            <div class="form-group">

            <label>Tag Title</label>                        
                <input class="form-control" type="text" name="title">
            </div>
            <input type="submit" class="btn btn-primary btn-sm" value="Add new Tag">
        </form>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <th>Tags</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                <td>{{$tag->title}}</td>
                <td>
                    <a href="{{ route('delete.tag',['id'=>$tag->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
