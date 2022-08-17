@extends('app')
@section('content')
<div class="container">
{{--        <h1>{{$user->username}}</h1>--}}
{{--        @foreach($user->categories as $category)--}}
{{--            <h2>{{$category->name}}</h2>--}}
{{--            <br>--}}

{{--    @endforeach--}}
        <h1>List categories</h1>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th></th>
                <th></th>
            </thead>

            @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td><a href="categories/{{$category->id}}/edit" class="btn btn-dark">Edit</a></td>
                <td>
                    <form method="post" action="{{route('categories.destroy',$category)}}">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </td>


            </tr>
            @endforeach
        </table>
    </div>
@endsection
