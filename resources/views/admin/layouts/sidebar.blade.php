<nav id="sidebar" style="height: 100vh">
    <div class="sidebar-header">
        <h3>ADMIN</h3>
    </div>

    <ul class="list-unstyled components">
        <p>Dashboard</p>
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Manage</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="{{route('users.index')}}">List users</a>
                </li>
                <li>
                    <a href="{{route('categories.index')}}">List categories</a>
                </li>
                <li>
                    <a href="{{route('posts.index')}}">List posts</a>
                </li>
            </ul>
        </li>


    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <a href="#" class="download">Download source</a>
        </li>
        <li>
            <a href="#" class="article">Back to article</a>
        </li>
    </ul>
</nav>

@section('js')
<script src="resources/js/sidebar.js">

</script>
@endsection