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
    $(document).ready(function() {
        $('table').dataTable(
            {
                paginate: false,
                // scrollY: 5
                  scrollY: 300

            }
        );
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

@endsection