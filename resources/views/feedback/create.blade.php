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
                            {{ session('success') }}{!! __('feedback.youMay') !!}<strong>{!! __('feedback.email') !!}</strong>{!! __('feedback.forResponse') !!}<a href="{{route('feedback.index')}}">{!! __('feedback.manageFeedback') !!}</a>{!! __('feedback.pageFor') !!}
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
                                        <h2>{!! __('feedback.weWant') !!}</h2>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-md-6">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong>{!! __('feedback.someProblem') !!}<br>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_name">{!! __('feedback.title') !!}</label>
                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="{!! __('feedback.titlePlaceholder') !!}" value="{{ old('title') }}" required="required" >
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
                                            <label for="form_message">{!! __('feedback.message') !!}</label>
                                            <textarea name="details" class="form-control @error('details') is-invalid @enderror" placeholder="{!! __('feedback.messagePlaceholder') !!}" rows="4" required="required">{{ old('details') }}</textarea>
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
                                        <input type="submit" class="btn btn-success btn-send pt-2 btn-block" value="{!! __('feedback.sendBtn') !!}" >
                                    </div>
                                    <div class="col-md-2">
                                        <input class="btn btn-danger pt-2 btn-block" type="reset" value="{!! __('feedback.resetBtn') !!}">
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
</body>
@endsection



