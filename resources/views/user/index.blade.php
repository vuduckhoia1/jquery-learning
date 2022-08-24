@extends('app')

@extends('shared/navbar')
@extends('shared/notification')

@section('content')


    <div class="container">
        <div class="pagination-user">
            @include('user.pagination',['users'=>$users])

        </div>
    </div>

    <script>
        $(document).on('click', '.pagination-user a', function (e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            getUsers(page);
        });
        function getUsers(page){
            $.ajax({
                url: '/ajax/users/?page='+page
            }).done(function (data){
                $('.pagination-user').html(data);
            });
        }
    </script>


@endsection
