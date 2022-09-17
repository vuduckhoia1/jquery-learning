@extends('admin.index')

@section('content')
<form method="post" action="{{route('admin.users.store')}}">
    @csrf
    <div class="mb-3">
        <label>Email <span class="text-danger">*</span></label>
        <input type="form-control" name="email" />
    </div>
    <div class="mb-3">
        <label>Username <span class="text-danger">*</span></label>
        <input type="form-control" name="username">
    </div>
    <div class="mb-3">
        <label>Password <span class="text-danger">*</span></label>
        <input type="password" name="password">
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Create">
        <a href="{{route('users.index')}}" class="btn btn-danger">Cancel</a>
    </div>
    <button class="btn btn-warning btn-add">Add skill</button>
    <table class="tbl-skill">
        <thead>
            <tr>

                <th>#</th>
                <th>Skill</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

</form>
@endsection

@section('js')
<script>
    $('.btn-add').on('click', function(e) {
        e.preventDefault();
        // console.log('dkfjdklfj');
        var $firstRow = $("table.tbl-skill tr:first-child");
        var $newRow = $firstRow.clone()
        $newRow.find("input[type=text]").val('');
        $("table#Table").append($newRow);
    })
</script>
@endsection