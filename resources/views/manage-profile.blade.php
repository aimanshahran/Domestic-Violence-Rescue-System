@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/content-styles.css')}}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
    <script>
        var base_url = '{{ url("/") }}';
    </script>
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
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
    <!-- CHAT BUTTON -->
    @user
        @include('nav.chat')
    @enduser
    <!-- CHAT BUTTON -->
    <div id="verifyModal" class="modal fade" tabindex="-1" role="dialog">
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
                    <form class="d-inline" action="{{ route('verification.resend') }}" method="POST" >
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
                            <span class="font-weight-bold">{{ Auth::user()->name }} ({{ Auth::user()->role->name }})</span><span class="text-black-50">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete">Delete Account</button>
                            <form action="{{ route('manage-profile.destroy') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="OTP" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                @include('layouts.logo')
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-justify">
                                                <h3>{!! __('Delete Alert!') !!}</h3>
                                                <p>{!! __('When you delete your account, your data will be permanently removed this is include your records in our system.') !!}</p>
                                                <div class="mt-4"><button type="submit" class="btn btn-danger btn-lg float-right">OKAY</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
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
                            <form action = "{{ route('manage-profile.edit') }}" method = "post">
                                @csrf
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="labels">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ Auth::user()->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels pr-3">Mobile Number</label>
                                            <span class="badge badge-success">Verified</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text form-control" id="basic-addon1">+60</span>
                                            </div>
                                            <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number" value="{{ old('phone') ?? (Auth::user()->phone) }}" readonly>
                                            &nbsp;
                                            <a href="{{ route('change-phone-number') }}" class="btn btn-dark mb-2">Change</a>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels pr-3">Email</label>
                                        @if((Auth::user()->email_verified_at)!=NULL)
                                            <span class="badge badge-success">Verified</span>
                                        @else
                                            <button type="button" class="badge badge-danger" data-toggle="modal" data-target="#verifyModal" style="border: 0;">Not Verified</button>
                                        @endif
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') ?? Auth::user()->email }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Gender</label>
                                        <select name="gender" class="custom-select @error('gender') is-invalid @enderror" id="inputGroupSelect02">
                                            <option @if((Auth::user()->gender_id)==NULL)selected
                                                    @endif value="">Choose...</option>
                                            @foreach($gender as $genders)
                                                <option @if((Auth::user()->gender_id)==($genders->id))selected
                                                        @endif value="{{$genders->id}}">{{$genders->type}}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-block change-btn mb-4" type="submit">Save Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">{{ __('Change Password') }}</h4>
                            </div>
                            @if (session('success1'))
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ session('success1') }}
                                </div>
                            @elseif(session('unsuccessful1'))
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ session('unsuccessful1') }}
                                </div>
                            @endif
                            <div class="justify-content-between align-items-center">
                                    <form action = "{{ route('manage-profile.editpassword') }}" method = "post">
                                        @csrf
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label class="labels">Old password</label>
                                                <input type="password" name="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" placeholder="Old Password" ">
                                                @error('oldpassword')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label class="labels">New password</label>
                                                <input type="password" name="newpassword" class="form-control @error('newpassword') is-invalid @enderror" placeholder="New Password" ">
                                                @error('newpassword')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label class="labels">Confirm password</label>
                                                <input type="password" name="confirm" class="form-control @error('confirm') is-invalid @enderror" placeholder="Confirm Password" ">
                                                @error('confirm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <button class="btn btn-block change-btn mb-4"><i class="fa fa-key"></i>&nbsp;&nbsp;Change Password</button>
                                        </div>
                                    </form>
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection
