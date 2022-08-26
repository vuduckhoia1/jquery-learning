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
                <form method="post" action="{{route('categories.destroy',$category->id)}}">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </td>


        </tr>
    @endforeach

</table>
<div class="pagination-list">

    {{ $categories->onEachSide(5)->links() }}
</div>
