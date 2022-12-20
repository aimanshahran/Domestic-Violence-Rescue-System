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
        body {
            width: 100%;
            height: 90%;
        }
        .s-header-no-index{
            margin-bottom: 0;
        }
    </style>
    </head>
    <body>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
            <div class="map" id="app" >
            </div>


    <!-- /.row-->
<!--    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALiAsEpXW9QCdQD1ZN29xzizLNohMYKhE&callback=initMap"></script>
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

        const chicago = { lat: 41.85, lng: -87.65 };

        /**
         * Creates a control that recenters the map on Chicago.
         */
        function createCenterControl(map) {
            const controlButton = document.createElement("button");

            // Set CSS for the control.

            controlButton.className = "btn btn-danger";
            controlButton.style.textAlign = "center";
            controlButton.style.alignItems = "center";
            controlButton.textContent = "I NEED EMERGENCY HELP";
            controlButton.title = "Click to recenter the map";
            controlButton.type = "submit";

            // Setup the click event listeners: simply set the map to Chicago.
            controlButton.addEventListener("click", () => {
                map.setCenter(chicago);
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

            // Create the DIV to hold the control.
            const centerControlDiv = document.createElement("div");
            // Create the control.
            const centerControl = createCenterControl(map);

            // Append the control to the DIV.
            centerControlDiv.appendChild(centerControl);
            map.controls[google.maps.ControlPosition.BOTTOM_RIGHT].push(centerControlDiv);
        }
    </script>-->
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection



