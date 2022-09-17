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
        <td><a data-id="{{$user->id}}" href="#" class="btn btn-warning edit-btn">Edit</a></td>
        <td><a href="#" class="btn btn-danger">Destroy</a></td>
    </tr>
    @endforeach
</table>
<a href="{{route('admin.users.create')}}" class="btn btn-primary">Create new user</a>
@endsection

@section('js')
<script>
    $('.edit-btn').on('click', function(e) {
        e.preventDefault();
        $.fn.editable.defaults.mode = 'inline';
        var user_id = $(this).parent().parent().data('id');
        console.log(user_id);
        editUser(user_id);

    })

    function editUser(id){
        
    }
</script>
<!-- <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script> -->
@endsection