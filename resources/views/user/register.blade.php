@extends('app')
@section('content')
<div class="row">
    <div class="col-md-6">
        @extends('shared/notification')

        <form method="post" action="{{route('register.action')}}">
            @csrf
            <div class="mb-3">
                <label>Email <span class="text-danger">*</span></label>
                <input type="form-control" name="email" value="{{old('email')}}" />
            </div>
            <div class="mb-3">
                <label>Username <span class="text-danger">*</span></label>
                <input type="form-control" name="username" value="{{old('username')}}">
            </div>
            <div class="mb-3">
                <label>Password <span class="text-danger">*</span></label>
                <input type="password" name="password">
            </div>
            <div class="mb-3">
                <label>Password Confirmation <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Register</button>
                <a href="{{route('home')}}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
