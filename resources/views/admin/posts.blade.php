@extends('layouts.backend')

@section('content')
<div class="card card-default">
    <div class="card-header">Posts</div>

    <div class="card-body">
        <table class="table">
            <thead>
                <th>Posts</th>
                <th>Trash</th>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                <td>{{$post->title}}</td>
                <td>
                    <a href="{{ route('admin.delete.post',['id'=>$post->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
