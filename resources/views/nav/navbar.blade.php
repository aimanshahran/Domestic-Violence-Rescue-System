<!-- # site header ================================================== -->
<link rel="stylesheet" href="{{ URL::asset('css/navstyle.css') }}">
@if(Request::is('/','home'))
    <header class="s-header">

        <div class="row s-header__inner">

            <div class="s-header__block">
                <div class="s-header__logo">
                    <a class="logo" href="{{ url('/') }}">
                        <img src="{{ URL::asset('svg/logo.svg') }}" alt="Homepage">
                    </a>
                </div>

                <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
            </div><!-- end s-header__block -->

            <nav class="s-header__nav">
                <ul>
                    <li class="current"><a href="#intro" class="smoothscroll">Home</a></li>
                    <li><a href="#about" class="smoothscroll">About Us</a></li>
                    <li><a href="#">DV Information</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Statistics</a></li>
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="d-none">{{ __('Login') }}</a></li>
                        @endif
                    @else
                        <li @if(Route::is('feedback'))class="current"@endif><a href="@if(Route::is('feedback'))@else{{ route('feedback') }}@endif">Feedback</a></li>
                        <li><a href="{{ route('manage-profile') }}" class="n-none" >Manage Profile</a></li>
                        <li><a href="{{ route('manage-feedback') }}" class="n-none" >Manage Feedback</a></li>
                        <li><a href="{{ route('logout') }}" class="n-none"
                               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="f-none">
                            @csrf
                        </form>
                    @endguest
                </ul>
            </nav>

            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <nav class="s-header__cta">
                        <a href="{{ route('login') }}" class="btn btn--stroke s-header__cta-btn">{{ __('Login') }}</a>
                    </nav>
                @endif
            @else
                <nav class="s-header__cta">
                    <div class="dropdown">
                        <button class="btn btn--stroke s-header__cta-btn">{{ __('Hi, ') }}{{ ucfirst(Auth::user()->name) }}&nbsp;&nbsp;<i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <a href="{{ route('manage-profile') }}">{{ __('Manage Profile') }}</a>
                            <a href="{{ route('manage-feedback') }}">{{ __('Manage Feedback') }}</a>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="f-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </nav>
            @endguest
        </div> <!-- end s-header__inner -->
    </header>
@else
    <header class="s-header-no-index">

        <div class="row s-header__inner">

            <div class="s-header__block">
                <div class="s-header__logo">
                    <a class="logo" href="{{ url('/') }}">
                        <img src="{{ URL::asset('svg/logo.svg') }}" alt="Homepage">
                    </a>
                </div>

                <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
            </div><!-- end s-header__block -->

            <nav class="s-header__nav">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/#about') }}" class="smoothscroll">About Us</a></li>
                    <li><a href="#">DV Information</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Statistics</a></li>
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="d-none">{{ __('Login') }}</a></li>
                        @endif
                    @else
                        <li @if(Route::is('feedback'))class="current"@endif><a href="@if(Route::is('feedback'))@else{{ route('feedback') }}@endif">Feedback</a></li>
                        <li><a href="{{ route('manage-profile') }}" class="n-none" >Manage Profile</a></li>
                        <li><a href="{{ route('manage-feedback') }}" class="n-none" >Manage Feedback</a></li>
                        <li><a href="{{ route('logout') }}" class="n-none"
                               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="f-none">
                            @csrf
                        </form>
                    @endguest
                </ul>
            </nav>

            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <nav class="s-header__cta">
                        <a href="{{ route('login') }}" class="btn btn--stroke s-header__cta-btn">{{ __('Login') }}</a>
                    </nav>
                @endif
            @else
                <nav class="s-header__cta">
                    <div class="dropdown">
                        <button class="btn btn--stroke s-header__cta-btn">{{ __('Hi, ') }}{{ ucfirst(Auth::user()->name) }}&nbsp;&nbsp;<i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <a href="{{ route('manage-profile') }}">{{ __('Manage Profile') }}</a>
                            <a href="{{ route('manage-feedback') }}">{{ __('Manage Feedback') }}</a>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="f-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </nav>
            @endguest
        </div> <!-- end s-header__inner -->
    </header>
@endif
<!-- end s-header -->
