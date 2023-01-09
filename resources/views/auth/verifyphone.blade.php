@extends('layouts.header')

@if (!session('phone'))
    @php
        header("Location: " . URL::to('/registerphone'), true, 302);
        exit();
    @endphp
@endif

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
                                <div class="otpForm">
                                    <h3>{{ __('OTP Verification') }}</h3>
                                    @if(session('unsuccessful'))
                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            {{ session('unsuccessful') }}
                                        </div>
                                    @endif
                                    @error('verification_code')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <p>We have sent you 6 digits OTP code for +60{{session('phone')}}.</p>
                                    <form action="{{route('verify-phone.verify')}}" method="POST">
                                        @csrf
                                    <input type="hidden" name="phone" value="{{session('phone')}}">
                                    <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                        <input class="m-2 text-center form-control rounded" type="text" name="first"
                                               maxlength="1"/>
                                        <input class="m-2 text-center form-control rounded" type="text" name="second"
                                               maxlength="1"/>
                                        <input class="m-2 text-center form-control rounded" type="text" name="third"
                                               maxlength="1"/>
                                        <input class="m-2 text-center form-control rounded" type="text" name="fourth"
                                               maxlength="1"/>
                                        <input class="m-2 text-center form-control rounded" type="text" name="fifth"
                                               maxlength="1"/>
                                        <input class="m-2 text-center form-control rounded" type="text" name="sixth"
                                               maxlength="1" />
                                    </div>
                                    <div class="d-flex flex-row justify-content-center mt-8">
                                        <p>Please wait <span id="countdowntimer" style="color: #622c8c">60 </span> seconds to resend</p>
                                    </div><br><br>
                                        <button type="submit" class="btn btn-block button--loading login-btn mb-4">
                                            {{ __('Verify') }}
                                        </button>
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
                const inputs = document.querySelectorAll('#otp > *[name]');
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
