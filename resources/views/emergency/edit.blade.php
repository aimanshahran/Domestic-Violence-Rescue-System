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
            <div class="container rounded bg-white mt-5 mb-5">
                <h2><a href="{{ url()->previous() }}" style="color: black"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Case ID - {{ $emergency->id }}</h2>
                <table class="table table-active table-borderless table-hover" style="width:100%;border-radius: 5px">
                    <tr>
                        <th scope="col" style="width:15%">Name</th>
                        <td>{{ $emergency->user->name ?? 'Not registered' }}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Phone</th>
                        <td><a href="tel: {{'+60'.$emergency->phone}}">{{'+60'.$emergency->phone}}</a>&nbsp;&nbsp;<span class="badge badge-success">Verified</span></td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Longitude</th>
                        <td>{{ $emergency->longitude }}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Latitude</th>
                        <td>{{ $emergency->latitude }}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Details</th>
                        <td>{{ $emergency->details }}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Category</th>
                        <td>
                        @foreach($category as $categories)
                            {{ ucfirst($categories->caseName->name) }}@if(!$loop->last), @endif
                        @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Photo Evidence</th>
                        <td>
                            @forelse($photo as $photos)
                                <a href="{{URL::asset('img/uploads/'.$photos->photo_name)}}" target="_blank" rel="noopener noreferrer""><img src="{{URL::asset('img/uploads/'.$photos->photo_name)}}" width="50px" height="50px"></a>
                            @empty
                                No image submitted
                            @endforelse
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Severity status</th>
                        <td>{{ $emergency->severity->name}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Report time</th>
                        <td>{{ $emergency->created_at}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Status</th>
                        <td>{{ ucfirst($emergency->statusCase->name)}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:15%">Remark</th>
                        <td>
                            <textarea name="remark" class="form-control @error('remark') is-invalid @enderror" placeholder="Write your remark here" rows="4">{{ old('remark') ?? $emergency->remark }}</textarea>
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



