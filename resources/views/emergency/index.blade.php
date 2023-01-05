@extends('layouts.header')

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
            width: 100%;
            height: 100%;
        }
        .s-header-no-index{
            margin-bottom: 0;
        }

        .emergencyBtn{
            margin: 5px 20px;
            padding: 10px 30px 10px 30px;
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

        .noEmergencyBtn{
            margin: 5px 20px;
            padding: 10px 30px 10px 30px;
            background-color: #FFC107;
            color: #FFF;
            font-weight: 800;
            text-align: center;
            align-items: center;
        }

        .noEmergencyBtn:hover{
            background-color: #E2AA02;
            color: #FFF;
        }
    </style>
    </head>
    <body>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
        <div class="map" id="map" ></div>

    <div class="modal fade" id="allow" tabindex="-1" role="dialog" aria-labelledby="OTP" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @include('layouts.logo')
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-justify">
                    <h3>{!! __('Turn on Location Services on your browser') !!}</h3>
                    <p>{!! __('To use this service, you must allow us to access your location when you are using the app') !!}</p>
                    <p>{!! __('By activating this location service, it allows us to use your device\'s location, such as GPS information, to give the exact location to the authorities.') !!}</p>
                    <p>
                        <a id="link" href="" target="_blank" rel="noopener noreferrer">Click here to learn how to turn on your location in browser</a>
                    </p>
                    <p><b>{!! __('alert.close') !!}</b></p>
                    <div class="mt-4">
                        <button class="btn emergencyBtn btn-lg float-right" class="close" data-dismiss="modal">OKAY</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row-->
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

        function createEmergencyButton() {
            const controlButton = document.createElement("button");

            // Set CSS for the control.
            controlButton.id = "reportBtn";
            controlButton.className = "btn emergencyBtn";
            controlButton.textContent = "I NEED EMERGENCY HELP";
            controlButton.title = "Click to report";
            controlButton.type = "submit";

            controlButton.addEventListener("click", () => {
                window.location.href = "<?php echo URL::to('emergency/welcome'); ?>";
            });
            return controlButton;
        }

        function createNoEmergencyButton() {
            const controlButton = document.createElement("button");

            // Set CSS for the control.
            controlButton.className = "btn noEmergencyBtn"
            controlButton.textContent = "I don't need immediate help";
            controlButton.title = "Click to exit";
            controlButton.type = "submit";

            // Setup the click event listeners: simply set the map to Chicago.
            controlButton.addEventListener("click", () => {
                window.location.href = "<?php echo URL::to('emergency/welcome'); ?>";
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
                onError: function errorHandler(err){
                    if( (err.code == 1)|| (err.code == 2) || (err.code == 3) ){
                        $('#allow').modal('show');
                    }
                }
            });

            // Create the DIV to hold the control.
            const emergencyControlDiv = document.createElement("div");
            const noEmergencyControlDiv = document.createElement("div");
            // Create the control.
            const emergencyButton = createEmergencyButton();
            const noEmergencyButton = createNoEmergencyButton();

            // Append the control to the DIV.
            emergencyControlDiv.appendChild(emergencyButton);
            noEmergencyControlDiv.appendChild(noEmergencyButton);
            map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(emergencyControlDiv);
            map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(noEmergencyControlDiv);
        }
    </script>
    <script>
        let userAgent = navigator.userAgent;
        let browserName;

        if(userAgent.match(/chrome|chromium|crios/i)){
            document.getElementById('link').href = "https://support.google.com/chrome/answer/142065?hl=en";
        }else if(userAgent.match(/firefox|fxios/i)){
            document.getElementById('link').href = "https://support.mozilla.org/en-US/kb/does-firefox-share-my-location-websites";
        }  else if(userAgent.match(/safari/i)){
            document.getElementById('link').href = "https://support.apple.com/en-gb/guide/mac-help/mh35873/mac";
        }else if(userAgent.match(/opr\//i)){
            document.getElementById('link').href = "https://help.opera.com/en/latest/web-preferences/";
        } else if(userAgent.match(/edg/i)){
            document.getElementById('link').href = "https://support.microsoft.com/en-us/microsoft-edge/location-and-privacy-in-microsoft-edge-31b5d154-0b1b-90ef-e389-7c7d4ffe7b04";
        }else{
            document.getElementById('link').href = "";
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection



