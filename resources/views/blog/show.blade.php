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
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
    <div class="col mx-auto">
        <div class="card card-2">
            <div class="container pt-5">
                <h2><a href="{{ url()->previous() }}" style="color: black"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>&nbsp;Blog</h2>
                <div class="row align-items-center">
                    <div class="col">
                        <h4>{{ ucfirst($blog->title) }}</h4>
                    </div>
                    <div class="col-offset-* my-auto">
                        <p>Posted at: {{date_format($blog->created_at, "d/m/Y")}}</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <span>Writer: {{ ($blog->user->name) }} | Updated on: {{date_format($blog->updated_at, "d/m/Y")}}</span>
                    </div>
                </div>
                <div class="row align-items-center" style="padding-top: 20px">
                    <div class="col">
                        <p>{!! html_entity_decode($blog->content) !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.8 -->
    </div>
    <!-- /.row-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    </body>
@endsection



