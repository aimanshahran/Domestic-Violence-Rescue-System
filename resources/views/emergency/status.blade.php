@extends('layouts.header')

@section('content')
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/content-styles.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/chosen.css')}}">
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
                <div style="text-align: center">
                    @if(session('success'))
                        <img src="{{ URL::asset('svg/success.svg') }}" alt="success" width="15%">
                        <h3>{{ __('We received your report!') }}</h3>
                        <p>Our authorities may contact you for more information.
                            Please inform your trusted family or friend about your situation. If you manage to escape before authorities reach you,
                            please find the nearest safe place or local police station.</p>

                        <p>You may check your report status in ‘<a href="{{ route('manage-emergency') }}">Manage Emergency</a>’ page if you are registered in this system.
                            If you did not register yet, please <a href="{{ route('register') }}">register</a> to this system or wait until our authorities contact you.</p>
                    @else
                        <img src="{{ URL::asset('svg/error.svg') }}" alt="success" width="15%">
                        <h3>{{ __('Ops! Something went wrong!') }}</h3>
                        <p>If your connection lost in the middle of processing, it will more likely your
                        report didn't been recorded in this system. Please wait until 10 minutes. If our authorities did not call you,
                            you may try to start a <a href="{{ route('emergency.index') }}">new</a> report.</p>

                        <p>If you're running out of time, please directly call <a href="tel: 15999">Talian Kasih</a>.</br>We are sorry for any inconvenience caused.</p>

                        <p>You may check if your report recorded in the system by browsing ‘<a href="{{ route('manage-emergency') }}">Manage Emergency</a>’ page if you are registered in this system.
                            If you did not register yet, please <a href="{{ route('register') }}">register</a> to this system or wait until our authorities contact you.</p>
                    @endif
                </div>
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
                    document.getElementById('lat').value = `${lat}`;
                    document.getElementById('long').value = `${lng}`;
                },
                onError: err =>
                    alert(`Error: ${getPositionErrorMessage(err.code) || err.message}`)
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/chosen.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/init.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection
