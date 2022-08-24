@extends('app')

@extends('shared/navbar')
@extends('shared/notification')

@section('content')


    <div class="container">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <th>#</th>
                <th>Email</th>
                <th>Username</th>
                <th></th>
                <th></th>
            </thead>

            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->username}}</td>
                <td><a href="update/{{$user->id}}" class="btn btn-dark">Edit</a></td>
                <td><a href="delete/{{$user->id}}" class="btn btn-danger">Delete</a></td>

            </tr>
            @endforeach
        </table>
    </div>


@endsection
