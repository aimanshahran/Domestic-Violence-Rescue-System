@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
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

        .multiple-uploader {
            display: inline-flex;
            flex-wrap: wrap;
            justify-content: center;
            border-radius: 15px;
            border: 2px dashed #858585;
            max-height: 120px;
            margin: 0 auto;
            cursor: pointer;
            width: 70%;
            overflow-y: scroll;
            -ms-overflow-y: scroll;
            white-space: nowrap;
        }

        .mup-msg {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .mup-msg span {
            margin-bottom: 10px;
        }

        .mup-msg .mup-main-msg {
            color: #606060;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .mup-msg .mup-msg {
            color: #737373;
        }

        .image-container{
            margin: 1rem;
            width: 120px;
            height: 120px;
            position: relative;
            cursor: auto;
            pointer-events: unset;
        }

        .image-container:before {
            z-index: 3;
            content: "\2716";
            align-content: center;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            line-height: 22px;
            color: white;
            position: absolute;
            top: -5px;
            left: -5px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #e50000;
            pointer-events: all;
            cursor: pointer;
        }

        .image-preview {
            position: absolute;
            width: 90px;
            height: 90px;
            border-radius: 12px;
        }

        .image-size {
            position: absolute;
            z-index: 1;
            height: 120px;
            width: 120px;
            backdrop-filter: blur(4px);
            font-weight: bolder;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            opacity: 0;
            pointer-events: unset;
        }

        .image-size:hover {
            opacity: 1;
        }

        .exceeded-size
        {
            position: absolute;
            z-index: 2;
            height: 120px;
            width: 120px;
            display: flex;
            font-weight: bold;
            font-size: 12px;
            text-align: center;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: white;
            background: rgba(255, 0, 0, 0.6);
            pointer-events: unset;
        }

        #loader {
            border: 12px solid #000000;
            border-radius: 50%;
            border-top: 12px solid #622c8c;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .center {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
    </style>
    </head>
    <body>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->

    <div id="loader" class="center"></div>
    <div class="map" id="map" ></div>
    <div class="contactform">
        <div class="col">
            <div class="card">
                <div class="brand-wrapper">
                    @include('layouts.logo')
                    <a href="{{ url('/') }}" type="button" style="float: right" class="close">×</a>
                </div>
                <h3>{{ __('Report form') }}</h3>
                @if(session('unsuccessful'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('unsuccessful') }}
                    </div>
                @endif
                <p>{{__('We need you to give us details about your case')}}</p>
                <form action="{{route('emergency.store')}}" method="POST" id="my-form" name="emergencyForm">
                    @csrf
                    <div class="form-group" style="margin-bottom: 10px;">
                        <input type="hidden" name="phone" value="{{session('phone')}}" readonly>
                        <input type="hidden" id="lat" name="lat" value="" readonly>
                        <input type="hidden" id="long" name="long" value="" readonly>
                        <label class="labels pr-3">*The details of accident:</label>
                        <textarea id="details" class="form-control @error('details') is-invalid @enderror" name="details" placeholder="Details...." value="{{ old('details') }}" rows="3" required></textarea>
                        @error('details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <table class="table table-borderless" style="width:100%;">
                        <tr>
                            <th scope="col" style="width:25%;font-weight: unset;padding-left: 0;">Types of violence:</th>
                            <td style="padding: 0;">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <select multiple="multiple" class="custom-select col-md-9 col-sm" data-placeholder="Describe more..." name="category[]">
                                            <option value=""></option>
                                            @foreach($category as $categories)
                                                <option value="{{$categories->id}}">{{$categories->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" style="width:25%;font-weight: unset;padding-left: 0;">Upload:</th>
                            <td style="padding: 0;">
                                <div class="form-group">
                                    <div class="multiple-uploader" id="multiple-uploader">
                                        <div class="mup-msg">
                                            <span class="mup-main-msg">click to upload images.</span>
                                            <span class="mup-msg" id="max-upload-number">Upload up to 5 images</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    *required
                    <div style="float: right;">
                        <button type="submit" id="reportBtn" style="color: grey;border:none;background-color: transparent" data-dismiss="modal" data-toggle="modal" data-target="#security">
                            {{ __('Skip and report now >>') }}
                        </button></br>
                        <button type="submit" id="reportBtn2" class="btn emergencyBtn float-right" data-dismiss="modal" data-toggle="modal" data-target="#security">
                            {{ __('SUBMIT') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


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
                onError: function errorHandler(err){
                    if( (err.code == 1)|| (err.code == 2) || (err.code == 3) ){
                        document.getElementById("reportBtn").disabled = true;
                        document.getElementById("reportBtn2").disabled = true;
                        document.getElementById("reportBtn").title = "Please turn on location before proceed";
                        document.getElementById("reportBtn2").title = "Please turn on location before proceed";
                    }
                }
            });
        }
    </script>
    <script src="{{ URL::asset('js/multiple-uploader.js')}}"></script>
    <script>

        let multipleUploader = new MultipleUploader('#multiple-uploader').init({
            maxUpload : 5, // maximum number of uploaded images
            maxSize:5, // in size in mb
            filesInpName:'images', // input name sent to backend
            formSelector: '#my-form', // form selector
        });
    </script>
    <script>
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                    ".contactform").style.visibility = "hidden";
                document.querySelector(
                    "#loader").style.visibility = "visible";
            } else {
                document.querySelector(
                    "#loader").style.display = "none";
                document.querySelector(
                    ".contactform").style.visibility = "visible";
            }
        };
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALiAsEpXW9QCdQD1ZN29xzizLNohMYKhE&callback=initMap"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/chosen.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/init.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection
