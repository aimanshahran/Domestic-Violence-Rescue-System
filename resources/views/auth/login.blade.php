@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/login.css')}}">
    <!-- Favicon -->
    @include('nav.favicon')
    <!-- Favicon -->
    </head>
    <body>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <picture>
                            <source srcset="{{ URL::asset('img/login-card.avif') }}" type="image/avif">
                            <source srcset="{{ URL::asset('img/login-card.webp') }}" type="image/webp">
                            <img src="{{ URL::asset('img/login-card.png') }}" alt="dvrs-login-card" class="login-card-img">
                        </picture>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <a href="{{ url('/') }}" type="button" class="close">×</a>
                            <div class="brand-wrapper">
                                @include('layouts.logo')
                            </div>
                            @if (session('message'))
                                <div class="alert alert-danger col-md-9" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ session('message') }}
                                </div>
                            @endif
                            <h3>{!! __('auth.signIn') !!}</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{!! __('auth.email') !!}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{!! __('auth.p') !!}" required="required" autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {!! __('auth.rememberMe') !!}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <button type="submit" class="btn btn-block button--loading login-btn mb-4">
                                            {!! __('auth.login') !!}
                                        </button>
                                    </div>
                            </form>
                            <p class="login-card-footer-text">
                                <a href="{{ route('login-otp') }}" class="text-reset">{!! __('auth.loginOTP') !!}</a></br>
                                {!! __('auth.dontHave') !!}<a href="{{ route('register') }}" class="text-reset">{!! __('auth.reg') !!}</a>
                                @if (Route::has('password.request'))
                                    </br>
                                    <a href="{{ route('password.request') }}" class="text-reset">
                                        {!! __('auth.forgotP') !!}
                                    </a>
                                @endif
                            </p>
                            <nav class="login-card-footer-nav">
                                <a href="#!">{!! __('auth.terms') !!}</a>
                                <a href="#!">{!! __('auth.policy') !!}</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </body>
@endsection

