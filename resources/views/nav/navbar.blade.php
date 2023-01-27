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

                <a class="s-header__menu-toggle" href="#"><span>{!! __('nav.menu') !!}</span></a>
            </div><!-- end s-header__block -->

            <nav class="s-header__nav">
                <ul>
                    <li class="current"><a href="#intro" class="smoothscroll">{!! __('nav.home') !!}</a></li>
                    @guest
                        <li><a href="#about" class="smoothscroll">{!! __('nav.about') !!}</a></li>
                    @else
                        @if(((Auth::user()->role_id)==1) || ((Auth::user()->role_id)==5))
                            <li @if(str_contains(Route::currentRouteName(), 'emergency'))class="current"@endif><a href="{{ url('/emergency') }}">{!! __('nav.emergency') !!}</a></li>
                        @else
                            <li><a href="#about" class="smoothscroll">{!! __('nav.about') !!}</a></li>
                        @endif
                    @endguest
                    <li @if(str_contains(Route::currentRouteName(), 'DV-Information'))class="current"@endif><a href="{{ url('/dvinfo') }}">{!! __('nav.dvinfo') !!}</a></li>
                    <li @if(str_contains(Route::currentRouteName(), 'blog'))class="current"@endif><a href="{{ url('/blog') }}">{!! __('nav.blog') !!}</a></li>
                    <li @if(str_contains(Route::currentRouteName(), 'statistic'))class="current"@endif><a href="{{ url('/statistic') }}">{!! __('nav.stat') !!}</a></li>
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="n-none">{!! __('nav.login') !!}</a></li>
                        @endif
                    @else
                        <li><a href="@if((Auth::user()->role_id)==1){{ route('feedback.index') }}@else{{ route('feedback.create') }}@endif">{!! __('nav.feedback') !!}</a></li>
                        <li><a href="{{ route('manage-profile') }}" class="n-none" >{!! __('nav.manage_profile') !!}</a></li>
                        @if((Auth::user()->role_id)==2)
                            <li><a href="{{ route('manage-emergency') }}" class="n-none">{!! __('nav.manage_emergency') !!}</a></li>
                        @endif
                        @if((Auth::user()->role_id)==1)
                            <li><a href="{{ route('manage-user.index') }}" class="n-none">{!! __('nav.manage_user') !!}</a></li>
                        @endif
                        @if((Auth::user()->role_id)!=1)
                        <li><a href="{{ route('feedback.index') }}" class="n-none" >{!! __('nav.manage_feedback') !!}</a></li>
                        @endif
                        <li><a href="{{ route('logout') }}" class="n-none"
                               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{!! __('nav.logout') !!}</a></li>
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
                        <a href="{{ route('login') }}" class="btn btn--stroke s-header__cta-btn">{!! __('nav.login') !!}</a>
                    </nav>
                @endif
            @else
                <nav class="s-header__cta">
                    <div class="dropdown">
                        <button class="btn btn--stroke s-header__cta-btn">{!! __('nav.Hi') !!},&nbsp;{{ ucfirst(Auth::user()->name) }}&nbsp;&nbsp;<i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <a href="{{ route('manage-profile') }}">{!! __('nav.manage_profile') !!}</a>
                            @if((Auth::user()->role_id)==2)
                                <a href="{{ route('manage-emergency') }}">{!! __('nav.manage_emergency') !!}</a>
                            @endif
                            @if((Auth::user()->role_id)==1)
                                <a href="{{ route('manage-user.index') }}">{!! __('nav.manage_user') !!}</a>
                            @endif
                            @if((Auth::user()->role_id)!=1)
                                <a href="{{ route('feedback.index') }}">{!! __('nav.manage_feedback') !!}</a>
                            @endif
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {!! __('nav.logout') !!}
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

                <a class="s-header__menu-toggle" href="#"><span>{!! __('nav.menu') !!}</span></a>
            </div><!-- end s-header__block -->

            <nav class="s-header__nav">
                <ul>
                    <li><a href="{{ url('/') }}">{!! __('nav.home') !!}</a></li>
                    @guest
                        <li><a href="{{ url('/#about') }}" class="smoothscroll">{!! __('nav.about') !!}</a></li>
                    @else
                        @if(((Auth::user()->role_id)==1) || ((Auth::user()->role_id)==5))
                            <li @if(str_contains(Route::currentRouteName(), 'emergency'))class="current"@endif><a href="{{ url('/emergency') }}">{!! __('nav.emergency') !!}</a></li>
                        @else
                            <li><a href="{{ url('/#about') }}" class="smoothscroll">{!! __('nav.about') !!}</a></li>
                        @endif
                    @endguest
                    <li @if(str_contains(Route::currentRouteName(), 'DV-Information'))class="current"@endif><a href="{{ url('/dvinfo') }}">{!! __('nav.dvinfo') !!}</a></li>
                    <li @if(str_contains(Route::currentRouteName(), 'blog'))class="current"@endif><a href="{{ url('/blog') }}">{!! __('nav.blog') !!}</a></li>
                    <li @if(str_contains(Route::currentRouteName(), 'statistic'))class="current"@endif><a href="{{ url('/statistic') }}">{!! __('nav.stat') !!}</a></li>
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="n-none">{!! __('nav.login') !!}</a></li>
                        @endif
                    @else
                        <li @if(str_contains(Route::currentRouteName(), 'feedback'))class="current"@endif><a href="@if((Auth::user()->role_id)==1){{ route('feedback.index') }}@else{{ route('feedback.create') }}@endif">{!! __('nav.feedback') !!}</a></li>
                        <li><a href="{{ route('manage-profile') }}" class="n-none" >{!! __('nav.manage_profile') !!}</a></li>
                        @if((Auth::user()->role_id)==2)
                            <li><a href="{{ route('manage-emergency') }}" class="n-none">{!! __('nav.manage_emergency') !!}</a></li>
                        @endif
                        @if((Auth::user()->role_id)==1)
                            <li><a href="{{ route('manage-user.index') }}" class="n-none">{!! __('nav.manage_user') !!}</a></li>
                        @endif
                        @if((Auth::user()->role_id)!=1)
                            <li><a href="{{ route('feedback.index') }}" class="n-none" >{!! __('nav.manage_feedback') !!}</a></li>
                        @endif
                        <li><a href="{{ route('logout') }}" class="n-none"
                               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{!! __('nav.logout') !!}</a></li>
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
                        <a href="{{ route('login') }}" class="btn btn--stroke s-header__cta-btn">{!! __('nav.login') !!}</a>
                    </nav>
                @endif
            @else
                <nav class="s-header__cta">
                    <div class="dropdown">
                        <button class="btn btn--stroke s-header__cta-btn">{!! __('nav.Hi') !!},&nbsp;{{ ucfirst(Auth::user()->name) }}&nbsp;&nbsp;<i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <a href="{{ route('manage-profile') }}">{!! __('nav.manage_profile') !!}</a>
                            @if((Auth::user()->role_id)==2)
                                <a href="{{ route('manage-emergency') }}">{!! __('nav.manage_emergency') !!}</a>
                            @endif
                            @if((Auth::user()->role_id)==1)
                                <a href="{{ route('manage-user.index') }}">{!! __('nav.manage_user') !!}</a>
                            @endif
                            @if((Auth::user()->role_id)!=1)
                                <a href="{{ route('feedback.index') }}">{!! __('nav.manage_feedback') !!}</a>
                            @endif
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {!! __('nav.logout') !!}
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
