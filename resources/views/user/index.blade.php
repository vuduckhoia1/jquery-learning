@extends('app')

@section('content')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
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
</body>

</html>


@endsection
