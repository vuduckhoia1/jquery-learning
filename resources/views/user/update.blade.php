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
    <div class="row">
        <div class="col-md-6">
            @if($errors->any())
            @foreach($errors->all() as $err)
            <p class="alert-danger">{{$err}}</p>
            @endforeach
            @endif
            <form method="post" action="/users/update/{{$user->id}}">
                @csrf
                <div class="mb-3">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="form-control" name="email" value="{{$user->email}}" />
                </div>
                <div class="mb-3">
                    <label>Username <span class="text-danger">*</span></label>
                    <input type="form-control" name="username" value="{{$user->username}}">
                </div>
                <div class="mb-3">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" name="password">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('user.index')}}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

@endsection