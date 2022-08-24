@extends('app')
@section('content')
<div class="row">
    <div class="col-md-6">
        @extends('shared/notification')

        <form method="post" action="{{route('categories.store')}}">
            @csrf
            <div class="mb-3">
                <label>Name <span class="text-danger">*</span></label>
                <input type="form-control" name="name" />
            </div>

            <div class="mb-3">
                <button class="btn btn-primary">Create</button>
                <a href="/categories" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
