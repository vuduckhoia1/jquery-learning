<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <div class="container-fluid justify-content-between">
        <!-- Left elements -->
        <div class="d-flex my-2 my-sm-0">
            <!-- Toggler -->

            <!-- Brand -->
            <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="{{route('posts.index')}}">
                <strong style="color: darkblue">BaceFook</strong>
            </a>

            <!-- Search form -->
            <form class="input-group w-auto my-auto d-none d-sm-flex">
                <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search"
                       style="min-width: 125px" />
                <span class="input-group-text border-0 d-none d-lg-flex"><i class="fas fa-search"></i></span>
            </form>
        </div>
        <!-- Left elements -->


        <!-- Right elements -->
        <ul class="navbar-nav flex-row">
            <li class="nav-item me-3 me-lg-1">
                <a class="nav-link d-sm-flex align-items-sm-center" href="/users/update/{{\Illuminate\Support\Facades\Auth::user()->id}}">
                    <img src="https://mdbootstrap.com/img/new/avatars/1.jpg" class="rounded-circle" height="22" alt=""
                         loading="lazy" />
                    <strong class="d-none d-sm-block ms-1">{{\Illuminate\Support\Facades\Auth::user()->username}}</strong>
                </a>
            </li>
            <li class="nav-item me-3 me-lg-1">
                <a class="nav-link" href="#">
                    <span><i class="fas fa-plus-circle fa-lg"></i></span>
                </a>
            </li>
            <li class="nav-item dropdown me-3 me-lg-1">
                <a class="nav-link dropdown-toggle hidden-arrow" href="{{route('user.index')}}" id="navbarDropdownMenuLink" role="button"
                   data-mdb-toggle="dropdown" aria-expanded="false">


                    <i class="icon-user"></i>
                </a>

            </li>
            <li class="nav-item dropdown me-3 me-lg-1">
                <a class="nav-link dropdown-toggle hidden-arrow" href="{{route('categories.index')}}" id="navbarDropdownMenuLink" role="button"
                   data-mdb-toggle="dropdown" aria-expanded="false">
                    <i class="icon-filter"></i>
                </a>

            </li>
            <li class="nav-item dropdown me-3 me-lg-1">
                <a class="nav-link dropdown-toggle hidden-arrow" href="{{route('logout')}}" id="navbarDropdownMenuLink" role="button"
                   data-mdb-toggle="dropdown" aria-expanded="false">
                    <i class="icon-off"></i>
                </a>
            </li>
        </ul>
        <!-- Right elements -->
    </div>
</nav>
<!-- Navbar -->
