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

        .card-emergency{
            margin: auto;
            border: 1px solid #FFFFFF;
            border-radius: 26px;
            width: 700px;
            padding: 10px;
            background: #fff;
            overflow: hidden;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            min-height: 600px;
        }

        @media (max-width: 729px) {
            .card {
                width: auto;
            }
        }
    </style>
    </head>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
    @admin_authorities
    <div class="col mx-auto">
        <div class="card card-2">
            <div class="container pt-5">
                <h2>Manage Emergency</h2>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                @elseif(session('unsuccessful'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('unsuccessful') }}
                    </div>
                @endif
                <div class="input-group col-md-4 mb-3" style="float: right" >
                    <input type="text" id="myInput" class="form-control py-2 border-right-0 border" placeholder="Search for id..." onkeyup="myFunction()" >
                    <span class="input-group-append">
                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <table id="emergencyDetails" class="table table-bordered table-striped table-hover" style="width:100%;border: none;">
                    <thead class="thead-purple">
                    <tr>
                        <th scope="col" style="width:15%;text-align: center;vertical-align: middle;">Case ID</th>
                        <th scope="col" style="width:30%;text-align: center;vertical-align: middle;">Name/Phone number</th>
                        <th scope="col" style="width:20%;text-align: center;vertical-align: middle;">Report</th>
                        <th scope="col" style="width:20%;text-align: center;vertical-align: middle;">Status</th>
                        <th scope="col" style="width:15%;text-align: center;vertical-align: middle;">Archive</th>
                    </tr>
                    </thead>
                    @forelse($emergencies as $emergency)
                        <tbody>
                        <td style="text-align: center">{{$emergency->id}}</td>
                        <td style="text-align: center">{{$emergency->name ?? '+60'.$emergency->phone }}</td>
                        <td style="text-align: center"><a type="button" class="btn btn-primary" href="{{route('emergency.edit', $emergency->id)}}">Details</a></td>
                        {{--<td>{{date_format($emergency->updated_at, "d/m/Y h.i A")}}</td>--}}
                        <td style="text-align: center">{{$emergency->status}}</td>
                        <td style="text-align: center">
                            <form action="{{ route('emergency.destroy' , $emergency->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE" />
                                <a type="button" class="fas fa-trash-can" data-toggle="modal" data-target="#confirm"></a>
                                <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-s" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Warning!</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p>Are you sure you want to delete blog {{ $emergency->id }}?</p>
                                                <div class="mt-4"><button type="submit" class="btn btn-success btn-lg">YES</button>&nbsp<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close">NO</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                        </tbody>
                    @empty
                        <td colspan="6" style="text-align: center">{{ 'No emergency as '.date_format(now(), "d-m-Y H:i:s") }}</td>
                    @endforelse
                </table>
                {!! $emergencies->links() !!}
            </div>
        </div>
    </div>
    @else
    <div class="map" id="map" ></div>
    <div class="contactform">
        <div class="col">
            <div class="card-emergency">
                    <div class="brand-wrapper">
                        @include('layouts.logo')
                        <a href="{{ url('/') }}" type="button" style="float: right" class="close">×</a>
                    </div>
                    <h2>Don't worry!</br>We are here to help!</h2>
                    @if(Auth::user())
                        <p>Before begin.... please agree the terms and conditions below</p>
                    @else
                        <p>Before begin.... please key-in your phone number</p>
                    @endif
                    <form id="otp" method="POST" action="{{ route('emergency.sms') }}">
                        @csrf
                        <div class="form-group col-md-6 col-sm">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text form-control" id="basic-addon1">+60</span>
                                </div>
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number" value="@if(Auth::user()) {{Auth::user()->phone}} @elseif(old('phone')) {{old('phone')}} @endif" @if(Auth::user()) readonly @endif required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input @error('confirm') is-invalid @enderror" type="checkbox" value="" name="confirm" required>
                                <label class="form-check-label">
                                    By checking this box, I hereby confirm that I got abused and need immediate help by authorities.
                                </label>
                                @error('confirm')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input @error('aware') is-invalid @enderror" type="checkbox" value="" name="aware" required>
                                <label class="form-check-label">
                                    I aware that I will be suspended if I misused this system and authorities have a right to issue legal action.
                                </label>
                                @error('aware')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" value="" name="terms" required>
                                <label class="form-check-label">
                                    By checking this box, I agree to terms and condition for this function
                                </label>
                                @error('aware')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        </br>
                        </br>
                        <button id="reportBtn" type="button" class="btn emergencyBtn float-right" data-dismiss="modal" data-toggle="modal" data-target="#security">
                            {{ __('REPORT NOW') }}
                        </button>
            </div>
        </div>
    </div>
                        <div class="modal fade" id="security" tabindex="-1" role="dialog" aria-labelledby="OTP" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        @include('layouts.logo')
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-justify">
                                        <h3>{!! __('alert.alert_title') !!}</h3>
                                        <p>{!! __('alert.sms_monitored', [ 'url' => 'tel:15999' ]) !!}</p>
                                        <p>{!! __('alert.send_message') !!}</p>
                                        <p><b>{!! __('alert.close') !!}</b></p>
                                        <div class="mt-4">
                                            <button type="submit" class="btn emergencyBtn btn-lg float-right">OKAY</button>
                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    @endadmin_authorities

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

    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("emergencyDetails");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
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
                onError: function errorHandler(err){
                    if( (err.code == 1)|| (err.code == 2) || (err.code == 3) ){
                        $('#allow').modal('show');
                        document.getElementById("reportBtn").disabled = true;
                        document.getElementById("reportBtn").title = "Please turn on location before proceed";
                    }
                }
            });
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALiAsEpXW9QCdQD1ZN29xzizLNohMYKhE&callback=initMap"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection
