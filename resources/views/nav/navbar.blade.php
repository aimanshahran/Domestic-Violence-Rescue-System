<!-- # site header ================================================== -->
<link rel="stylesheet" href="{{ URL::asset('css/navstyle.css') }}">

{{-- FOR HOME PAGE --}}
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
                    @guest
                        <li><a href="#about" class="smoothscroll">About Us</a></li>
                    @else
                        @if((Auth::user()->role_id)==1)
                            <li><a href="#">Emergency</a></li>
                        @else
                            <li><a href="#about" class="smoothscroll">About Us</a></li>
                        @endif
                    @endguest
                    <li><a href="#">DV Information</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Statistics</a></li>
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="n-none">{{ __('Login') }}</a></li>
                        @endif
                    @else
                        <li><a href="@if((Auth::user()->role_id)==1){{ route('feedback.index') }}@else{{ route('feedback.create') }}@endif">Feedback</a></li>
                        <li><a href="{{ route('manage-profile') }}" class="n-none" >Manage Profile</a></li>
                        @if((Auth::user()->role_id)!=1)
                        <li><a href="{{ route('feedback.index') }}" class="n-none" >Manage Feedback</a></li>
                        @endif
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
                            @if((Auth::user()->role_id)!=1)
                            <a href="{{ route('feedback.index') }}">{{ __('Manage Feedback') }}</a>
                            @endif
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
{{-- FOR OTHER THAN HOME PAGE --}}
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
                    @guest
                        <li><a href="{{ url('/#about') }}" class="smoothscroll">About Us</a></li>
                    @else
                        @if((Auth::user()->role_id)==1)
                            <li><a href="#">Emergency</a></li>
                        @else
                            <li><a href="{{ url('/#about') }}" class="smoothscroll">About Us</a></li>
                        @endif
                    @endguest
                    <li><a href="{{route('feedback.index')}}">DV Information</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Statistics</a></li>
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="d-none">{{ __('Login') }}</a></li>
                        @endif
                    @else
                        <li @if(str_contains(Route::currentRouteName(), 'feedback'))class="current"@endif><a href="@if((Auth::user()->role_id)==1){{ route('feedback.index') }}@else{{ route('feedback.create') }}@endif">Feedback</a></li>
                        <li><a href="{{ route('manage-profile') }}" class="n-none" >Manage Profile</a></li>
                        @if((Auth::user()->role_id)!=1)
                        <li><a href="{{ route('feedback.index') }}" class="n-none" >Manage Feedback</a></li>
                        @endif
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
                            @if((Auth::user()->role_id)!=1)
                            <a href="{{ route('feedback.index') }}">{{ __('Manage Feedback') }}</a>
                            @endif
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
