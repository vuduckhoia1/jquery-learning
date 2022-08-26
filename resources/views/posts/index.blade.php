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

                            <p>Category<input type="text" name="category" class="form-control typeahead"></p>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Post">
                    </form>
                </section>

            </div>
        </div>
    </div>
    <div class="col-md-1"></div>

</div>
<div class="pagination-post">
    @include('posts.pagination',['posts'=>$posts])
</div>
@endsection

@section('js')
<script>
    var path = "{{route('autocomplete.search.query')}}";
    $(document).ready(function() {
        $(document).on('click', '.pagination-post .pagination-list a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getPosts(page);
        });

        $('.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    });

    function getPosts(page) {
        $.ajax({
            url: '/ajax/posts/?page=' + page
        }).done(function(data) {
            $('.pagination-post').html(data);
        });
    }
</script>
@endsection