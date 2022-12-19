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
    </head>
    <body>
        <div class="col mx-auto my-auto">
            <div class="card card-2">
                <div class = "container-error">
                    <h2>@yield('title')</h2><br>
                    <p>Error @yield('code') | @yield('message')</p>
                    <br>
                    <small>Redirecting you to the <a href="@php url()->previous() @endphp">right place</a></small>
                        <div class="loader">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    @php
                        header("refresh:4; url=" . url()->previous());
                    @endphp
                </div>
            </div>
        </div>
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="{{ URL::asset('js/nav.js') }}"></script>
    </body>
@endsection
