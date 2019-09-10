<nav class="navbar navbar-expand-md navbar-light navbar-laravel shadow-sm border-bottom">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/') }}">
            My Project
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    @if(auth()->user()->is_admin)
                        @if(auth()->user()->unreadNotifications->count()>0)
                            <li class="nav-item">
                                <a
                                        class="nav-link font-weight-bold font-italic text-white badge btn btn-sm btn-info"
                                        href="{{route('notifications')}}" role="button" aria-haspopup="true"
                                        aria-expanded="false"
                                        v-pre>
                                    {{auth()->user()->unreadNotifications->count()}} new notifications
                                </a>


                            </li>
                        @endif
                    @endif
                @endauth
            </ul>
            <!-- Right Side Of Navbar -->

            <ul class="navbar-nav ml-auto">
                <form action="" method="GET" class="form-inline my-2 my-lg-0">
                    <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search"
                           aria-label="Search" value="{{request()->query('search')}}">
                    <input type="submit" class="d-none">
                </form>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item ">
                        <a class="nav-link font-italic text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link font-italic text-white"
                               href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <img class="rounded-circle" style="width: 50px;height:50px"
                             src='/storage/images/{{\Illuminate\Support\Facades\Auth::user()->photo}}'>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold font-italic text-white"
                           href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                           v-pre>
                            <span>{{ Auth::user()->name }} </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item font-italic"
                               href="{{ route('profile',['user'=>\Illuminate\Support\Str::slug(auth()->user()->name)]) }}">
                                Profile
                            </a>
                            @if(Auth::user()->is_admin)
                            <a class="dropdown-item font-italic"
                               href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                            @endif
                            <a class="dropdown-item font-italic" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
