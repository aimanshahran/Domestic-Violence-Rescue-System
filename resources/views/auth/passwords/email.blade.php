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
                            <h3>{!! __('auth.resetP') !!}</h3>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div class="input-group mb-3">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{!! __('auth.email') !!}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <button type="submit" class="btn btn-block button--loading login-btn mb-4">
                                            {!! __('auth.link') !!}
                                        </button>
                                    </div>
                            </form>
                            <p class="login-card-footer-text">
                                {!! __('auth.remember') !!} <a href="{{route('login')}}" class="text-reset">{!! __('auth.loginHere') !!}</a>
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


