@extends('app')

@extends('shared/navbar')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @extends('shared/notification')

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
                    <input type="password" name="password" required>
                </div>
                @if(auth()->user()->role==0)

                    <div class="mb-3" id="role">
                        <div class="form-check">
                            @if($user->role==0)
                                <input class="form-check-input" type="radio" name="role" id="flexRadioDefault1" value="0" checked>
                            @else
                                <input class="form-check-input" type="radio" name="role" value="0" id="flexRadioDefault1">
                            @endif
                            <label class="form-check-label" for="flexRadioDefault1">
                                Admin
                            </label>
                        </div>
                        <div class="form-check">
                            @if($user->role==1)
                            <input class="form-check-input" type="radio" name="role" value="1" id="flexRadioDefault2" checked>

                            @else
                                <input class="form-check-input" type="radio" name="role" value="1" id="flexRadioDefault2">

                            @endif
                            <label class="form-check-label" for="flexRadioDefault2">
                                User
                            </label>
                        </div>

                    </div>

                @else
                    <input class="form-check-input" type="radio" name="role" value="1" id="flexRadioDefault2" checked hidden>

                @endif
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('user.index')}}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
