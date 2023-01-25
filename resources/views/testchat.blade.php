<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chat App</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <script>
        var base_url = '{{ url("/") }}';
    </script>


</head>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                @if($users->count() > 0)
                    <h3>Pick a user to chat with</h3>
                    <ul id="users">
                        @foreach($users as $user)
                            <li><span class="label label-info">{{ $user->name }}</span> <a href="javascript:void(0);" class="chat-toggle" data-id="{{ $user->id }}" data-user="{{ $user->name }}">Open chat</a></li>
                        @endforeach
                    </ul>
                @else
                    <p>No users found! try to add a new user using another browser by going to <a href="{{ url('register') }}">Register page</a></p>
                @endif
            </div>
        </div>
        <div id="chat_box" class="chat_box pull-right" style="display: none">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat with <i class="chat-user"></i> </h3>
                            <span class="glyphicon glyphicon-remove pull-right close-chat"></span>
                        </div>
                        <div class="panel-body chat-area">
                        </div>
                        <div class="panel-footer">
                            <div class="input-group form-controls">
                                <textarea class="form-control input-sm chat_input" placeholder="Write your message here..."></textarea>
                                <button class="btn btn-primary btn-sm btn-chat" type="button" data-to-user="" disabled>
                                    <i class="glyphicon glyphicon-send"></i>
                                    Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" class="to_user_id" value="" />
        </div>
    </div>

    <div id="chat-overlay" class="row"></div>

    <audio id="chat-alert-sound" style="display: none" muted="muted">
        <source src="{{ asset('sound/facebook_chat.mp3') }}" />
    </audio>
</div>

<input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
<input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
<input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
