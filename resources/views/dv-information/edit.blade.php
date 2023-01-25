@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/content-styles.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/dvinfo.css')}}">
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
                <div class="row">
                    <div class="col-11">
                        <h2><a href="{{ route('DV-Information.show') }}" style="color: black"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>&nbsp;Domestic Violence information and safety planning</h2>

                        <div class="submitbtn-mobile">
                            <form action = "{{ route('DV-Information.update') }}" method="post">
                                @csrf
                                @method('PUT')
                            <button type="submit" class="btn btn-dark" >SAVE</button>
                        </div>

                        <div style="clear: both;"></div>

                        @if (session('success'))
                            <div class="alert alert-success col-md-9" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('success') }}
                            </div>
                        @elseif(session('unsuccessful'))
                            <div class="alert alert-danger col-md-9" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('unsuccessful') }}
                            </div>
                        @endif

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
                                                    <input name="id[]" value="{{ $dvinfo->id }}" hidden>
                                                    <input type="text" name="title[]" class="form-control" style="font-weight: bold" placeholder="Title" value="{{ $dvinfo->title }}">
                                                    <br>
                                                    <textarea name="contentfaq[]">
                                                    {!!html_entity_decode($dvinfo->content)!!}
                                                    </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                            <div class="col-1">
                                <div class="submitbtn">
                                    <button type="submit" class="btn btn-dark">SAVE</button>
                                </div>
                            </form>
                    </div>
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
    <script src="https://cdn.tiny.cloud/1/1tf6nfno3yi47i0rna6sogpqmrg2v0f8w12xpt60aegwbhq6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            menubar: false,
            plugins: [ 'quickbars' ],
            toolbar: 'undo redo | bold italic underline strikethrough | numlist bullist',
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection
