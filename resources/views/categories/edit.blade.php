@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            @if($errors->any())
                @foreach($errors->all() as $err)
                    <p class="alert-danger">{{$err}}</p>
                @endforeach
            @endif
            <form method="post" action="{{route('categories.update',$category)}}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="form-control" name="name" />
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary">Update</button>
                    <a href="/categories" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
