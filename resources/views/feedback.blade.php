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
            background-image: #dfe1e0;
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
  <div class="col mx-auto">
        <div class="card card-2">
            <div class="card-heading">
                <img src="{{ URL::asset('svg/feedback.svg') }}">
            </div>
            <div class="card-body">
                <div class = "container">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('success') }}You may check your <strong>email</strong> for response and <a href="{{route('manage-feedback')}}">manage feedback</a> page for status.
                        </div>
                    @elseif(session('unsuccessful'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('unsuccessful') }}
                        </div>
                    @endif
                    <form action = "{{ route('feedback') }}" method = "post">
                        @csrf
                      <div class="controls">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h2>We want your feedback!</h2>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-md-6">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems.<br>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_name">Title*</label>
                                        <input name="id" value="{{ Auth::user()->id }}" hidden>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Write your title here" value="{{ old('title') }}" required="required" >
                                        @if ($errors->has('title'))
                                            @foreach ($errors->get('title') as $error)
                                                <div class="alert alert-danger">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="form_message">Message*</label>
                                        <textarea name="details" class="form-control @error('details') is-invalid @enderror" placeholder="Write your feedback here" rows="4" required="required">{{ old('details') }}</textarea>
                                        @if ($errors->has('details'))
                                            @foreach ($errors->get('details') as $error)
                                                <div class="alert alert-danger">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-md-2">
                                  <input type="submit" class="btn btn-success btn-send pt-2 btn-block" value="Send" >
                                </div>
                                <div class="col-md-2">
                                    <input class="btn btn-danger pt-2 btn-block" type="reset" value="Reset">
                                </div>
                            </div>
                        </div>
                      </div>
                    </form>
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



