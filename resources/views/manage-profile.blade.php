@extends('layouts.header')

@section('content')
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Heebo:wght@300;400;500;600;700&display=swap");

        html {
            height: 100%;
        }

        body {
            background-color: #d0d0ce;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            min-height: 100%;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            font-family            : "Heebo", sans-serif;;
            font-weight            : 450;
            color                  : #161616;
            font-variant-ligatures : common-ligatures;
            text-rendering         : optimizeLegibility;
        }

        /* ==========================================================================
       #CARD
       ========================================================================== */
        .row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
        .card {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border: 0;
            min-height: 100%;
        }

        .card-2 {
            -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            width: 100%;
            display: table;
        }

        .card-2 .card-heading {
            background: url("../img/feedback.png");
            border-radius: 0;
            width: 32%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
            overflow: auto;
            display: table-cell;
            vertical-align: middle;
        }

        .card-heading img{
            width: 100px;
            height: 100px;
            margin: 0 auto;
            display:block;
        }

        .card-2 .card-body {
            display: table-cell;
            padding: 40px;
        }

        .container{
            padding-top: 20px;
        }

        .change-btn {
            padding: 13px 20px 12px;
            background-color: #000;
            border-radius: 4px;
            font-size: 17px;
            font-weight: bold;
            line-height: 20px;
            color: #fff;
            border-color: black;
        }

        .change-btn:hover {
            background-color: white;
            color: black;
        }

        @media (max-width: 767px) {
            .card-2 {
                display: block;
            }
            .card-2 .card-heading {
                display: none;
            }
            .card-2 .card-body {
                display: block;
                padding: 60px 50px;
            }
            .border-right{
                border-right: 0px;
            }
            .change-btn {
                padding: 13px 20px 12px;
                margin: 0;
            }
        }
    </style>
    <!-- Favicon -->
    @include('nav.favicon')
    <!-- Favicon -->
    <!-- navbar
    ================================================== -->
    @include('nav.navbar')
    <!-- navbar
================================================== -->
    </head>
    <body>
    <div id="simpleModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Verify Your Email Address') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    {{ __('Please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col mx-auto my-auto">
        <div class="card card-2">
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold">{{ Auth::user()->name }}</span><span class="text-black-50">{{ Auth::user()->email }}</span><span> </span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value="{{ Auth::user()->name }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Mobile Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text form-control" id="basic-addon1">+6</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Phone number" value="0{{ Auth::user()->phone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels pr-3">Email</label>
                            @if((Auth::user()->email_verified_at)!=NULL)
                            <span class="badge badge-success">Verified</span>
                            @else
                            <button class="badge badge-danger" data-toggle="modal" data-target="#simpleModal" style="border: 0;">Not Verified</button>
                            @endif
                            <input type="text" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Gender</label>
                            <select class="custom-select" id="inputGroupSelect02">
                                <option @if((Auth::user()->gender_id)==NULL)selected
                                    @endif>Choose...</option>
                                <option @if((Auth::user()->gender_id)==1)selected
                                        @endif value="1">Male</option>
                                <option @if((Auth::user()->gender_id)==2)selected
                                        @endif value="2">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-block change-btn mb-4" type="button">Save Profile</button></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="justify-content-between align-items-center"><button class="btn btn-block change-btn mb-4"><i class="fa fa-key"></i>&nbsp;&nbsp;Change Password</button></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    </body>
@endsection
