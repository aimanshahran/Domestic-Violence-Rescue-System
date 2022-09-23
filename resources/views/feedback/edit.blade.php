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
    <div class="col mx-auto my-auto">
        <div class="card card-2">
            <div class="container pt-5">
                <h2><a href="{{ url()->previous() }}" style="color: black"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Case ID - {{ $feedback->id }}</h2>
                <div class="table-responsive-lg  pt-4">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-active table-borderless table-hover" style="width:100%;border-radius: 5px">
                        <tr>
                            <th scope="col" style="width:10%">Name</th>
                            <td>{{ $feedback->user->name }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width:10%">Title</th>
                            <td>{{ $feedback->title }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width:10%">Message</th>
                            <td>{{ $feedback->details }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width:10%">Created at</th>
                            <td>{{ $feedback->created_at }}</td>
                        </tr>
                        <tr>
                            <th scope="col" style="width:10%">Reply</th>
                            <td><a href="mailto:{{ $feedback->user->email }}" class="btn btn-primary" style="color: white">Email</a></td>
                        </tr>
                        <tr>
                            <form action="{{ route('feedback.update',$feedback->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <th scope="col" style="width:10%">Status</th>
                                <td>
                                    <select name="status" class="custom-select @error('status') is-invalid @enderror">
                                        <option @if(( old('status') ?? $feedback->status)==NULL)selected
                                            @endif value="0">Choose...</option>
                                        <option @if(( old('status') ?? $feedback->status)==1)selected
                                                @endif value="1">Received</option>
                                        <option @if(( old('status') ?? $feedback->status)==2)selected
                                                @endif value="2">Reply</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                        </tr>
                        <tr>
                            <th scope="col" style="width:10%">Remark</th>
                            <td>
                                <textarea name="remark" class="form-control @error('remark') is-invalid @enderror" placeholder="Write your remark here" rows="4">{{ old('remark') ?? $feedback->remark }}</textarea>
                                @error('remark')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" style="width:10%"></th>
                            <td style="text-align: right;width:100%">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </td>
                        </tr>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
