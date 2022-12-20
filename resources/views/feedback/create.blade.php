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
            <div class="card-heading">
                <img src="{{ URL::asset('svg/feedback.svg') }}">
            </div>
            <div class="card-body">
                <div class = "container">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('success') }}You may check your <strong>email</strong> for response and <a href="{{route('feedback.index')}}">manage feedback</a> page for status.
                        </div>
                    @elseif(session('unsuccessful'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('unsuccessful') }}
                        </div>
                    @endif
                    <form action = "{{ route('feedback.store') }}" method="post">
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
    <script src="{{ URL::asset('js/exit.js') }}"></script>
</body>
@endsection



