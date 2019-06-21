@extends('layouts.backend')

@section('content')
<div class="">
    <div class="row justify-content-center">
            <div class="panel  panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Enable/Disable</th>
                            <th>Delete</th>


                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->varsity_id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->u_type}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->enabled=="1")                                   
                                    <a href="{{ route('user.disable', ['id'=>$user->id]) }}" class="btn btn-sm btn-danger">Disable</a>
                                    @else
                                    <a href="{{ route('user.enable', ['id'=>$user->id]) }}" class="btn btn-sm btn-success">Enable</a>

                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.delete',['id'=>$user->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
@endsection
