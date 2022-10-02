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
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
</body>
@endsection
