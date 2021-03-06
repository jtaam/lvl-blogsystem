<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="{{route('home')}}" class="logo"><img src="{{asset('assets/frontend/images/logo.png')}}" alt="{{ config('app.name', 'Laravel') }}"></a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('posts.index')}}">Posts</a></li>
            @guest()
                <li><a href="{{route('login')}}">Login</a></li>
            @else
                @if (isset(Auth::user()->role->id))
                    @if(Auth::user()->role->id == 1)
                        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li><a href="{{route('logout')}}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    @elseif(Auth::user()->role->id == 2)
                        <li><a href="{{route('author.dashboard')}}">Dashboard</a></li>
                        <li><a href="{{route('logout')}}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                @endif
            @endguest
        </ul><!-- main-menu -->

        <div class="src-area">
            <form method="get" action="{{route('search')}}">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input class="src-input" type="text" placeholder="Type of search" name="query" value="{{isset($query)?$query:''}}">
            </form>
        </div>

    </div><!-- conatiner -->
</header>