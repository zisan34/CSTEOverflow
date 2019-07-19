@extends('layouts.backend')

@section('content')
<div class="card card-default">
    <div class="card-header">Notices</div>


    <div class="card-body">
        <table class="table">
            <thead>
                <th>Notice</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($notices as $notice)
                <tr>
                <td>{{$notice->title}}</td>
                <td>
                    <a href="{{ route('admin.delete.notice',['id'=>$notice->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
