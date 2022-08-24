@extends('app')
@extends('shared/notification')

<h1>Please check your mail inbox and verify this account</h1>
<form action="{{route('verification.send')}}" method="post">
    @csrf
    <input type="submit" class="btn btn-warning" value="Resend the mail">
</form>
