@extends('app')
@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link type="text/css" href="css/postcss.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
                            <a href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
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

</div>
@endforeach

@endsection
