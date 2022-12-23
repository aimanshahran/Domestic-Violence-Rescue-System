@extends('layouts.header')

@if (!session('phone'))
    @php
        header("Location: " . URL::to('/emergency'), true, 302);
        exit();
    @endphp
@endif

@section('content')
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/content-styles.css')}}">
    <!-- Favicon -->
    @include('nav.favicon')
    <!-- Favicon -->
    <!-- navbar
    ================================================== -->
    @include('nav.navbar')
    <!-- navbar
================================================== -->
    <style>
        html, body {
            width: 100%;
            height: 90%;
        }

        .map{
            height: 100%;
            width: 100%;
            position:absolute;
            top: 0;
            left: 0;
            z-index: 0;
            opacity: 0.65;
        }

        .form-check-label{
            color: #5A5858;
        }

        .emergencyBtn{
            margin: 5px 20px;
            padding: 10px 20px 10px 20px;
            background-color: #FF0000;
            color: #FFF;
            font-weight: 800;
            text-align: center;
            align-items: center;
        }

        .emergencyBtn:hover{
            background-color: #E50202;
            color: #FFF;
        }

        .contactform {
            position: relative;
            z-index: 1; /* The z-index should be higher than Google Maps */
            opacity: 1; /* Set the opacity for a slightly transparent Google Form */
        }

        .card{
            margin: auto;
            border: 1px solid #FFFFFF;
            border-radius: 26px;
            width: 700px;
            padding: 10px;
        }

        @media (max-width: 729px) {
            .card {
                width: auto;
            }
        }
    </style>
    </head>
    <body>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->

    <div class="map" id="map" ></div>
    <div class="contactform">
        <div class="col">
            <div class="card">
                <div class="brand-wrapper">
                    @include('layouts.logo')
                    <a href="{{ url('/') }}" type="button" style="float: right" class="close">×</a>
                </div>
                <h3>{{ __('OTP Verification') }}</h3>
                @if(session('unsuccessful'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('unsuccessful') }}
                    </div>
                @endif
                <p>We have sent you 6 digits OTP code for +60{{session('phone')}}.</p>
                <form action="{{route('emergency-verify-phone.verify')}}" method="POST">
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
                    </div>
                    </br>
                    </br>
                    <button type="submit" class="btn emergencyBtn float-right" data-dismiss="modal" data-toggle="modal" data-target="#security">
                        {{ __('CONFIRM') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALiAsEpXW9QCdQD1ZN29xzizLNohMYKhE&callback=initMap"></script>
    <script>
        const createMap = ({ lat, lng }) => {
            return new google.maps.Map(document.getElementById('map'), {
                center: { lat, lng },
                zoom: 16,
                disableDefaultUI: true,
                zoomControl: false,
            });
        };

        const createMarker = ({ map, position }) => {
            return new google.maps.Marker({ map, position });
        };

        const getCurrentPosition = ({ onSuccess, onError = () => { } }) => {
            if ('geolocation' in navigator === false) {
                return onError(new Error('Geolocation is not supported by your browser.'));
            }

            return navigator.geolocation.getCurrentPosition(onSuccess, onError);
        };

        const getPositionErrorMessage = code => {
            switch (code) {
                case 1:
                    return 'Permission denied. Please allow us to access your location for better response.';
                case 2:
                    return 'Position unavailable.  Please allow us to access your location for better response.';
                case 3:
                    return 'Timeout reached. Please try again.';
                default:
                    return null;
            }
        }

        function createEmergencyButton() {
            const controlButton = document.createElement("button");

            // Set CSS for the control.
            controlButton.className = "btn emergencyBtn"
            controlButton.textContent = "I NEED EMERGENCY HELP";
            controlButton.title = "Click to recenter the map";
            controlButton.type = "submit";

            // Setup the click event listeners: simply set the map to Chicago.
            controlButton.addEventListener("click", () => {
                $('#myModal').modal('show');
            });
            return controlButton;
        }

        function createNoEmergencyButton() {
            const controlButton = document.createElement("button");

            // Set CSS for the control.
            controlButton.className = "btn emergencyBtn"
            controlButton.textContent = "I NEED EMERGENCY HELP";
            controlButton.title = "Click to recenter the map";
            controlButton.type = "submit";

            // Setup the click event listeners: simply set the map to Chicago.
            controlButton.addEventListener("click", () => {
                $('#myModal').modal('show');
            });
            return controlButton;
        }

        function initMap() {
            const initialPosition = { lat: 3.1575, lng: 101.7116};
            const map = createMap(initialPosition);
            const marker = createMarker({ map, position: initialPosition });

            getCurrentPosition({
                onSuccess: ({ coords: { latitude: lat, longitude: lng } }) => {
                    marker.setPosition({ lat, lng });
                    map.panTo({ lat, lng });
                },
                onError: err =>
                    alert(`Error: ${getPositionErrorMessage(err.code) || err.message}`)
            });
        }
    </script>
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
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection
