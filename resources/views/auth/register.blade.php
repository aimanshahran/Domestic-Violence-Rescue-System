@extends('layouts.header')

@if (!session('phone') AND !old('phone'))
    @php
        header("Location: " . URL::to('/registerphone'), true, 302);
        exit();
    @endphp
@endif

@section('content')
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
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
    <div class="container">
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
                    <div class="brand-wrapper">
                        @include('layouts.logo')
                    </div>
                    <div class="registerForm" >
                        <h3>{{ __('Register') }}</h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control" id="basic-addon1">+60</span>
                                    </div>
                                    <input id="phone" type="tel" class="form-control" name="phone" placeholder="Phone Number" value="{{ session('phone') ?? old('phone') }}" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                </div>
                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-block button--loading login-btn mb-4">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                                <div class="modal fade" id="security" tabindex="-1" role="dialog" aria-labelledby="OTP" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                    @include('layouts.logo')
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-justify">
                                                <h3>{!! __('alert.alert_title') !!}</h3>
                                                <p>{!! __('alert.monitored', [ 'url' => 'tel:15999' ]) !!}</p>
                                                <p>{!! __('alert.send_message') !!}</p>
                                                <p><b>{!! __('alert.close') !!}</b></p>
                                                <div class="mt-4"><button class="btn btn-danger btn-lg float-right">OKAY</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                    </div>
                        <span class="forgot-password-link"><a href="#!" class="forgot-password-link">Login with OTP</a></span>
                        <p class="login-card-footer-text">Already have an account? <a href="{{ route('login') }}" class="text-reset">Login here</a></p>
                        <nav class="login-card-footer-nav">
                        <a href="#!">Terms of use.</a>
                        <a href="#!">Privacy policy</a>
                        </nav>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </main>
    </div>
    {{--<script>
    $('#security').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
    </script>--}}

    {{--<script type="text/javascript">
        window.onload = function () {
            OpenBootstrapPopup();
        };
        function OpenBootstrapPopup() {
            $("#myModal").modal('show');
        }
    </script>--}}
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            function OTPInput() {
                const inputs = document.querySelectorAll('#otp > *[id]');
                for (let i = 0; i < inputs.length; i++) { inputs[i].addEventListener('keydown', function(event) { if (event.key==="Backspace" ) { inputs[i].value='' ; if (i !==0) inputs[i - 1].focus(); } else { if (i===inputs.length - 1 && inputs[i].value !=='' ) { return true; } else if (event.keyCode> 47 && event.keyCode < 58) { inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } else if (event.keyCode> 64 && event.keyCode < 91) { inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } } }); } } OTPInput();
        });

        var timeleft = 60;
        var downloadTimer = setInterval(function(){
            timeleft--;
            document.getElementById("countdowntimer").textContent = timeleft;
            if(timeleft <= 0)
                clearInterval(downloadTimer);
        },1000);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
@endsection
