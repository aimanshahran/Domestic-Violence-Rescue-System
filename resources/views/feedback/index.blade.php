@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
    <div class="col mx-auto my-auto">
        <div class="card card-2">
            <div class="container pt-5">
                <h2>Manage Feedback</h2>
                <div class="table-responsive-lg  pt-4">
                    <table class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead class="thead-purple">
                        <tr>
                            @if((Auth::user()->role_id)==1)
                                <th scope="col" style="width:10%;text-align: center">Case ID</th>
                                <th scope="col" style="width:20%;text-align: center">Name</th>
                                <th scope="col" style="width:20%;text-align: center">Title</th>
                                <th scope="col" style="width:40%;text-align: center">Message</th>
                                <th scope="col" style="width:10%;text-align: center">Details</th>
                            @else
                                <th scope="col" style="width:10%;text-align: center">Case ID</th>
                                <th scope="col" style="width:30%;text-align: center">Title</th>
                                <th scope="col" style="width:30%;text-align: center">Message</th>
                                <th scope="col" style="width:10%;text-align: center">Status</th>
                                <th scope="col" style="width:20%;text-align: center">Remark</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>

                        @if(count($feedbacks))
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    @if((Auth::user()->role_id)==1)
                                        <td style="text-align: center">{{ $feedback->id }}</td>
                                        <td>{{ $feedback->name }}</td>
                                        <td>{{ $feedback->title }}</td>
                                        <td>{{ $feedback->details }}</td>
                                        <td>
                                            <form action="{{route('feedback.edit', $feedback->id)}}" method="get">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Details</button>
                                            </form>
                                        </td>
                                    @else
                                        <td style="text-align: center">{{ $feedback->id }}</td>
                                        <td>{{ $feedback->title }}</td>
                                        <td>{{ $feedback->details }}</td>
                                        <td>{{ $feedback->status }}</td>
                                        <td>{{ $feedback->remark }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <td colspan="5" style="text-align: center">{{ 'No feedback as '.date_format(now(), "d-m-Y H:i:s") }}</td>
                        @endif
                        </tbody>
                    </table>
                    {!! $feedbacks->links() !!}
                </div>


                <div class="row">
                    <div class="col-md-5">
                        @if(($users->count()) > 0)
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
                <div id="chat-overlay" class="row"></div>
                </div>
                <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
                @include('chat/chat-box')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
</body>
@endsection
