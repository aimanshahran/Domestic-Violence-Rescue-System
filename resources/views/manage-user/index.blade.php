@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
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
            <div class="container rounded bg-white mt-5 mb-5">
                <h2>Manage User</h2>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                @elseif(session('unsuccessful'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('unsuccessful') }}
                    </div>
                @endif
                <table class="table table-bordered table-striped table-hover" style="width:100%;border: none;">
                    <thead class="thead-purple">
                    <tr>
                        <th class="borderless" colspan="6" style="text-align: right; border: none !important;"><a href="{{route('manage-user.create')}}" style="text-decoration:none;color: inherit;"><i class="fa-solid fa-circle-plus"  aria-hidden="true"></i></a></th>
                    </tr>
                    <tr>
                        <th scope="col" style="width:10%;text-align: center;vertical-align: middle;">ID</th>
                        <th scope="col" style="width:40%;text-align: center;vertical-align: middle;">Name</th>
                        <th scope="col" style="width:10%;text-align: center;vertical-align: middle;">Role</th>
                        <th scope="col" style="width:20%;text-align: center;vertical-align: middle;">Phone Number</th>
                        <th scope="col" style="width:10%;text-align: center;vertical-align: middle;">Edit</th>
                        <th scope="col" style="width:10%;text-align: center;vertical-align: middle;">Delete</th>
                    </tr>
                    </thead>
                    @forelse($users as $user)
                        <tbody>
                        <td style="text-align: center">{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td style="text-align: center">{{$user->role->name}}</td>
                        <td style="text-align: center"><a href="tel: 60{{$user->phone}}">60{{$user->phone}}</a></td>
                        <td style="text-align: center"><a href="{{ route('manage-user.edit', $user->id) }}" style="text-decoration:none;color: inherit;"><i class="fas fa-edit"></i></a></td>
                        <td style="text-align: center">
                            <form action="{{ route('manage-user.destroy', $user->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE" />
                                <a type="button" class="fas fa-trash-can" data-toggle="modal" data-target="#confirm{{$user->id}}"></a>
                                <div class="modal fade" id="confirm{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-s" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Warning!</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p>Are you sure you want to delete {{$user->name}}?</p>
                                                <div class="mt-4"><button type="submit" class="btn btn-success btn-lg">YES</button>&nbsp<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close">NO</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                        </tbody>
                    @empty
                        <td colspan="6" style="text-align: center">{{ 'No user as '.date_format(now(), "d-m-Y H:i:s") }}</td>
                    @endforelse
                </table>
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



