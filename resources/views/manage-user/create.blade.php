@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
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
    </head>
    <body>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
    <div class="col mx-auto">
        <div class="card card-2">
            <div class="container rounded bg-white mt-5 mb-5">
                <h2><a href="{{ route('manage-user.index') }}" style="color: black"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Create account</h2>
                <table class="table table-active table-borderless" style="width:100%;border-radius: 5px">
                    <form method="POST" action="{{ route('manage-user.store') }}">
                        @csrf
                    <tr>
                        <th scope="col" style="width:20%">Name</th>
                        <td>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:20%">Email</th>
                        <td>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:20%">Phone number</th>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text form-control" id="basic-addon1">+60</span>
                                </div>
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:20%">Gender</th>
                        <td>
                            <select name="gender_id" class="custom-select @error('gender_id') is-invalid @enderror" id="inputGroupSelect02">
                                <option @if(old('gender_id')==NULL)selected
                                        @endif value="">Choose gender...</option>
                                @foreach($genders as $gender)
                                    <option @if(old('gender_id')==($gender->id))selected
                                            @endif value="{{$gender->id}}">{{$gender->type}}</option>
                                @endforeach
                            </select>
                            @error('gender_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:20%">Role</th>
                        <td>
                            <select name="role_id" class="custom-select @error('role_id') is-invalid @enderror" id="inputGroupSelect02">
                                <option @if(old('role_id')==NULL)selected
                                        @endif value="">Choose role...</option>
                                @foreach($roles as $role)
                                    <option @if(old('role_id')==($role->id))selected
                                            @endif value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"></th>
                        <td style="text-align: right;width:100%">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Register') }}
                                </button>
                        </td>
                    </tr>
                    </form>
                    <tbody>
                    </tbody>
                </table>
        </div>
        <!-- /.8 -->
    </div>
    <!-- /.row-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection



