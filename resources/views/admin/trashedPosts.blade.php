@extends('layouts.backend')

@section('content')
<div class="card card-default">
    <div class="card-header">Trashed Posts</div>

    <div class="card-body">
        <table class="table">
            <thead>
                <th>Trashed Post</th>
                <th>Restore</th>
                <th>Delete from trash</th>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                <td>{{$post->title}}</td>
                <td><a href="{{ route('admin.restore.post',['id'=>$post->id]) }}" class="btn btn-sm btn-success">Restore Post</a></td>
                <td>
                    <a href="{{ route('admin.destroy.post',['id'=>$post->id]) }}" class="btn btn-sm btn-danger">Delete Permanently</a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
