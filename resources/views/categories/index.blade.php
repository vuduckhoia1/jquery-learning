@extends('app')

@extends('shared/navbar')

@section('content')
@extends('shared/notification')

<div class="container">

    <h1>List categories</h1>
    <div class="pagination-categories a">

        @include('categories.pagination',['categories'=>$categories])

    </div>
</div>

@endsection

@section('js')
<script>
    $(document).on('click', '.pagination-categories .pagination-list a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getCategories(page);
    });

    function getCategories(page) {
        $.ajax({
            url: '/ajax/categories/?page=' + page
        }).done(function(data) {
            $('.pagination-categories').html(data);
        });
    }
</script>
@endsection