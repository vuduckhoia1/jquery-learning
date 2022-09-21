@extends('admin.index')
@php
$roles=[
0 => "admin",
1 => "user"
];
@endphp
@section('content')
<table>
    <tr>
        <th>#</th>
        <th>Email</th>
        <th>Username</th>
        <th>Role</th>
        <th></th>
        <th></th>
    </tr>
    @foreach($users as $user)
    <tr data-id="{{$user->id}}">
        <td class="update">{{$user->id}}</td>
        <td class="update">{{$user->email}}</td>
        <td class="update">{{$user->username}}</td>
        <td class="update">{{$roles[$user->role]}}</td>
        <td><a href="{{route('admin.users.edit', $user)}}" class="btn btn-warning edit-btn">Edit</a></td>
        <td><a href="#" class="btn btn-danger">Destroy</a></td>
    </tr>
    @endforeach
</table>
<a href="{{route('admin.users.create')}}" class="btn btn-primary">Create new user</a>
@endsection

