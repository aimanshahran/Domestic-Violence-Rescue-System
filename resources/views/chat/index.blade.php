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
    <div class="col mx-auto">
        <div class="card card-2">
            <div class="container rounded bg-white mt-5 mb-5">
                <h3>Manage Patient</h3>
                <table class="table table-bordered table-striped table-hover" style="width:100%;border: none;">
                    <thead class="thead-purple">
                    <tr>
                        <th scope="col" style="width:20%;text-align: center;vertical-align: middle;">ID</th>
                        <th scope="col" style="width:30%;text-align: center;vertical-align: middle;">Name</th>
                        <th scope="col" style="width:30%;text-align: center;vertical-align: middle;">Phone Number</th>
                        <th scope="col" style="width:20%;text-align: center;vertical-align: middle;">Chat</th>
                    </tr>
                    </thead>
                    @forelse($users as $user)
                        <tbody>
                        <td style="text-align: center">{{ $user->id }}</td>
                        <td style="text-align: center">{{$user->name}}</td>
                        <td style="text-align: center">{{'+60'.$user->phone}}</td>
                        <td style="text-align: center"><a href="javascript:void(0);" class="chat-toggle" data-id="{{ $user->id }}" data-user="{{ $user->name }}">Open chat</a></td>
                        </tbody>
                    @empty
                        <td colspan="6" style="text-align: center">{{ 'No patient as '.date_format(now(), "d-m-Y H:i:s") }}</td>
                    @endforelse
                </table>
            <div id="chat-overlay" class="row"></div>
            </div>
            <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
            @include('chat/chat-box')
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



