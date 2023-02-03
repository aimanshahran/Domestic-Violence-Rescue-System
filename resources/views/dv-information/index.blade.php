@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/content-styles.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/dvinfo.css')}}">
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
    <div class="col mx-auto my-auto">
        <div class="card card-2">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-11">
                        <h2>{!! __('dvInfo.title') !!}</h2>

                        @admin_writer_authorities
                        <div class="submitbtn-mobile">
                            <a href="{{ route('DV-Information.edit') }}" class="btn btn-dark" role="button" aria-pressed="true">{!! __('dvInfo.edit') !!}</a>
                        </div>

                        <div style="clear: both;"></div>
                        @endadmin_writer_authorities

                        {{--TABS FOR DV INFORMATION--}}

                        <div id="tabs" class="nav nav-tabs">
                            @foreach($dvinfos as $count => $dvinfo)
                                <button id="tab-{{$count}}" href="#pane-{{$count}}"  @if($count == 0) class="active" @endif data-toggle="tab" role="tab">{{ $dvinfo->categoryName }}</button>
                            @endforeach
                        </div>

                        {{--CONTENT FOR TABS DV INFORMATION--}}
                        <div id="content" class="tab-content" role="tablist">
                        @foreach ($dvinfos as $count => $dvinfo)
                            <div id="pane-{{$count}}" class="card tab-pane fade show @if($count == 0) active @endif " role="tabpanel" aria-labelledby="tab-{{$count}}">
                                <button data-toggle="collapse" href="#collapse-{{$count}}" aria-expanded="true" aria-controls="collapse-{{$count}}">{{ $dvinfo->categoryName }}</button>
                                <div id="collapse-{{$count}}" class="collapse @if($count == 0) show @endif" role="tabpanel" data-parent="#content" aria-labelledby="heading-{{$count}}">
                                    <div class="card-content">
                                        <h4>{{ $dvinfo->title }}</h4>
                                        <br>
                                        {!!html_entity_decode($dvinfo->content)!!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @admin_writer_authorities
                    <div class="col-1">
                        <div class="submitbtn">
                            <a href="{{ route('DV-Information.edit') }}" class="btn btn-dark" role="button" aria-pressed="true">{!! __('dvInfo.edit') !!}</a>
                        </div>
                    </div>
                    @endadmin_writer_authorities
                </div>
            </div>
        </div>
    </div>
    <script>
        const accordion = document.getElementsByClassName('container');
        for (i=0; i<accordion.length; i++) {
            accordion[i].addEventListener('click', function () {
                this.classList.toggle('active')
            })
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection
