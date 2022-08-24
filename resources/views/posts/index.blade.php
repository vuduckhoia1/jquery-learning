@extends('app')

@extends('shared/navbar')

@section('content')
@extends('shared/notification')


<!------ Include the above in your HEAD tag ---------->
<div class="container">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body">
                <section class="post-heading">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object photo-profile" src="http://0.gravatar.com/avatar/38d618563e55e6082adf4c8f8c13f3e4?s=40&d=mm&r=g" width="40" height="40" alt="...">
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>
                <section class="post-body">
                    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>

                            <textarea name="content" class="form-control" cols="104" rows="4" placeholder="What's on your mind?"></textarea>
                            <input type="file" class="form-control" name="image">

                            <p>Category<input type="text" name="category" class="form-control"></p>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Post">
                    </form>
                </section>

            </div>
        </div>
    </div>
    <div class="col-md-1"></div>

</div>
@foreach($posts as $post)

<div class="container">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body">
                <section class="post-heading">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object photo-profile" src="http://0.gravatar.com/avatar/38d618563e55e6082adf4c8f8c13f3e4?s=40&d=mm&r=g" width="40" height="40" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="anchor-username">
                                        <h4 class="media-heading">{{$post->user->username}}</h4>
                                    </a>
                                    <a href="#" class="anchor-time">51 mins</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a data-bs-toggle="modal" data-bs-target="#exampleModal{{$post->id}}" class="dropdown-item" href="#">Edit post</a></li>


                                    <li>
                                    <form method="post" action="{{route('posts.destroy',$post->id)}}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="dropdown-item" value="Delete">
                                    </form>
                                    </li>
                                </ul>
                            </div>
{{--                            <a href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>--}}
                        </div>
                    </div>
                </section>
                <section class="post-body">
                    <p>{{$post->content}}</p>

                    @if(!is_null($post->images))

                    <img style="width: 100%;" class="image-content" src="{{url('public/Image/'.$post->images)}}">
                    @endif
                </section>

            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>

                            <textarea name="content" class="form-control" cols="104" rows="4" placeholder="What's on your mind?">{{$post->content}}</textarea>
                            <input type="file" class="form-control" name="image" >

                            <p>Category<input type="text" name="category" class="form-control" value="{{$post->category->name}}"></p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Post">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
