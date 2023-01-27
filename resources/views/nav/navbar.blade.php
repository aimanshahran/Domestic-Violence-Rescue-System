<!-- # site header ================================================== -->
<link href="{{ URL::asset('css/navstyle.css') }}" rel="stylesheet">

{{-- FOR HOME PAGE --}}
@if(Request::is('/','home'))
    <header class="s-header">

        <div class="row s-header__inner">

            <div class="s-header__block">
                <div class="s-header__logo">
                    <a class="logo" href="{{ url('/') }}">
                        @include('layouts.logo')
                    </a>
                </div>

                <a class="s-header__menu-toggle" href="#"><span>Menu</span></a>
            </div><!-- end s-header__block -->

            <nav class="s-header__nav">
                <ul>
                    <li class="current"><a href="#intro" class="smoothscroll">Home</a></li>
                    @guest
                        <li><a href="#about" class="smoothscroll">About Us</a></li>
                    @else
                        @if(((Auth::user()->role_id)==1) || ((Auth::user()->role_id)==5))
                            <li @if(str_contains(Route::currentRouteName(), 'emergency'))class="current"@endif><a href="{{ url('/emergency') }}">Emergency</a></li>
                        @elseif(((Auth::user()->role_id)==3))
                            <li @if(str_contains(Route::currentRouteName(), 'chat'))class="current"@endif><a href="{{ url('/chat') }}">Chat</a></li>
                        @else
                        <li><a href="#about" class="smoothscroll">About Us</a></li>
                        @endif
                    @endguest
                    <li @if(str_contains(Route::currentRouteName(), 'DV-Information'))class="current"@endif><a href="{{ url('/dvinfo') }}">DV Information</a></li>
                    <li @if(str_contains(Route::currentRouteName(), 'blog'))class="current"@endif><a href="{{ url('/blog') }}">Blog</a></li>
                    <li @if(str_contains(Route::currentRouteName(), 'statistic'))class="current"@endif><a href="{{ url('/statistic') }}">Statistics</a></li>
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="n-none">{{ __('Login') }}</a></li>
                        @endif
                    @else
                        <li><a href="@if((Auth::user()->role_id)==1){{ route('feedback.index') }}@else{{ route('feedback.create') }}@endif">Feedback</a></li>
                        <li><a href="{{ route('manage-profile') }}" class="n-none" >Manage Profile</a></li>
                        @if((Auth::user()->role_id)==2)
                            <li><a href="{{ route('manage-emergency') }}" class="n-none">{{ __('Manage Emergency') }}</a></li>
                        @endif
                        @if((Auth::user()->role_id)==1)
                            <li><a href="{{ route('manage-user.index') }}" class="n-none">{{ __('Manage User') }}</a></li>
                        @endif
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
                            @if((Auth::user()->role_id)==2)
                                <a href="{{ route('manage-emergency') }}">{{ __('Manage Emergency') }}</a>
                            @endif
                            @if((Auth::user()->role_id)==1)
                                <a href="{{ route('manage-user.index') }}">{{ __('Manage User') }}</a>
                            @endif
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
                        @include('layouts.logo')
                    </a>
                </div>

                <a class="s-header__menu-toggle" href="#"><span>Menu</span></a>
            </div><!-- end s-header__block -->

            <nav class="s-header__nav">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    @guest
                        <li><a href="{{ url('/#about') }}" class="smoothscroll">About Us</a></li>
                    @else
                        @if(((Auth::user()->role_id)==1) || ((Auth::user()->role_id)==5))
                            <li @if(str_contains(Route::currentRouteName(), 'emergency'))class="current"@endif><a href="{{ url('/emergency') }}">Emergency</a></li>
                        @elseif(((Auth::user()->role_id)==3))
                            <li @if(str_contains(Route::currentRouteName(), 'chat'))class="current"@endif><a href="{{ url('/chat') }}">Chat</a></li>
                        @else
                            <li><a href="{{ url('/#about') }}" class="smoothscroll">About Us</a></li>
                        @endif
                    @endguest
                    <li @if(str_contains(Route::currentRouteName(), 'DV-Information'))class="current"@endif><a href="{{ url('/dvinfo') }}">DV Information</a></li>
                    <li @if(str_contains(Route::currentRouteName(), 'blog'))class="current"@endif><a href="{{ url('/blog') }}">Blog</a></li>
                    <li @if(str_contains(Route::currentRouteName(), 'statistic'))class="current"@endif><a href="{{ url('/statistic') }}">Statistics</a></li>
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="n-none">{{ __('Login') }}</a></li>
                        @endif
                    @else
                        <li @if(str_contains(Route::currentRouteName(), 'feedback'))class="current"@endif><a href="@if((Auth::user()->role_id)==1){{ route('feedback.index') }}@else{{ route('feedback.create') }}@endif">Feedback</a></li>
                        <li><a href="{{ route('manage-profile') }}" class="n-none" >Manage Profile</a></li>
                        @if((Auth::user()->role_id)==2)
                            <li><a href="{{ route('manage-emergency') }}" class="n-none">{{ __('Manage Emergency') }}</a></li>
                        @endif
                        @if((Auth::user()->role_id)==1)
                            <li><a href="{{ route('manage-user.index') }}" class="n-none">{{ __('Manage User') }}</a></li>
                        @endif
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
                            @if((Auth::user()->role_id)==2)
                                <a href="{{ route('manage-emergency') }}">{{ __('Manage Emergency') }}</a>
                            @endif
                            @if((Auth::user()->role_id)==1)
                                <a href="{{ route('manage-user.index') }}">{{ __('Manage User') }}</a>
                            @endif
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
