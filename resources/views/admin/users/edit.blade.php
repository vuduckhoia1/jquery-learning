@extends('admin.index')

@section('content')
<form method="post" action="{{route('admin.users.update', $user)}}">
    @method('put')
    @csrf
    <div class="mb-3">
        <label>Email <span class="text-danger">*</span></label>
        <input type="form-control" name="email" class="ip-email" value="{{$user->email}}" />
    </div>
    <div class="mb-3">
        <label>Username <span class="text-danger">*</span></label>
        <input type="form-control" name="username" class="ip-username" value="{{$user->username}}">
    </div>
    <div class="mb-3">
        <label>Password <span class="text-danger">*</span></label>
        <input type="password" name="password" class="ip-password" value="{{$user->password}}">
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Update">
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
            @php
            $i=1;
            @endphp
            @foreach($skills as $skill)
            <tr>
                <td>{{$i}}</td>
                <td><input name='skills[{{($i++)-1}}]' class='ip-name' type='text' value='{{$skill->name}}'></td>

                <td><button class='btn btn-danger btn-del'>Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</form>
@endsection

@section('js')
<script>
    var skill_list = [];
    var i = {{$i++}};

    $(document).ready(function() {

        $('.tbl-skill > tbody > tr').each(function() {
            var data = $(this).find('input').val();
            skill_list.push(data);
        })
        console.log(skill_list);
        // for (x in skill_list) {
        //     // console.log(skill_list[i]);
        //     var $newRow = "<tr hidden>" +
        //         "<td>" + x + "</td>" +

        //         "<td><input name='skills[" + x + "]' class='ip-name' type='text' value='" + skill_list[x] + "'></td>" +

        //         "<td><button class='btn btn-danger btn-del'>Delete</button></td>" +
        //         "</tr>";

        //     $("table.tbl-skill").append($newRow);
        // }
    })
    $('.btn-add').on('click', function(e) {
        e.preventDefault();
        // console.log('dkfjdklfj');
        var $newRow = "<tr>" +
            "<td>" + i + "</td>" +

            "<td><input name='skills[" + (i - 1) + "]' class='ip-name' type='text' value=''></td>" +

            "<td><button class='btn btn-danger btn-del'>Delete</button></td>" +
            "</tr>";
        $("table.tbl-skill").append($newRow);
        var $btn = "<button class='btn btn-primary btn-add-skill'>Add</button>";
        $("form").append($btn);
    })

    $('body').on('click', '.btn-add-skill', function(e) {
        e.preventDefault();
        i++;
        var $newRow = "<tr>" +
            "<td>" + i + "</td>" +
            "<td><input name='skills[" + (i - 1) + "]' class='ip-name' type='text' value=''></td>" +
            "<td><button class='btn btn-danger btn-del'>Delete</button></td>" +
            "</tr>";

        $("table.tbl-skill").append($newRow);
    })

    $('body').on('click', '.btn-del', function(e) {
        e.preventDefault();

        $(this).closest('tr').remove();
    })

    // $('body').on('submit', 'form', function(e) {
    //     e.preventDefault();
    //     $('.tbl-skill > tbody > tr').each(function() {
    //         var data = $(this).find("input").val();
    //         skill_list.push(data);

    //     })
    // console.log(skill_list);
    // console.log($('.ip-password').val());
    // $.ajax({
    //     type: 'POST',
    //     data: {
    //         "_token": "{{ csrf_token() }}",
    //         email: $('.ip-email').val(),
    //         username: $('.ip-username').val(),
    //         password: $('ip-password').val(),
    //     },
    //     url: "{{route('admin.users.store')}}",
    //     success: function(data) {

    //         alert('test');

    //     }
    // });
    // })
</script>
@endsection