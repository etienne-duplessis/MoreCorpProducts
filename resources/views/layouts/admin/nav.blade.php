<div class="fixed-nav fixed-top">
    <nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-xs-12 col-md-3 col-md-2 mr-0" href="#">@if (Auth::check()){{Auth::user()->name}}@endif</a>
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
                    <li class="nav-item text-nowrap d-sm-block d-md-none">
                        <a class="nav-link" href="/products">Products List</a>
                    </li>
                    <li class="nav-item text-nowrap d-sm-block d-md-none">
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
    @if ($flash = session('message'))

        <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $flash }}
        </div>

    @endif
</div>