<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">@if (Auth::check()){{Auth::user()->name}}@endif</a>
    {{--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}
    @if (Route::has('login'))
        <ul class="navbar-nav px-3">

            @auth
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"
                    >
                        Sign out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                <li class="nav-item text-nowrap d-sm-inline-block d-md-none">
                    <a class="nav-link" href="/products">Products List</a>
                </li>
                <li class="nav-item text-nowrap d-sm-inline-block d-md-none">
                    <a class="nav-link" href="/products/create">Create New Product</a>
                </li>
            @else
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                {{--<li class="nav-item text-nowrap">--}}
                    {{--<a class="nav-link" href="{{ route('register') }}">Register</a>--}}
                {{--</li>--}}
            @endauth
        </ul>
    @endif
</nav>