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
            <div class="container pt-5">
                <h2><a href="{{ route('blog.index') }}" style="color: black"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>&nbsp;Manage Blog</h2>
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
                <table class="table table-borderless" style="width:100%;">
                    <tr>
                        <form action = "{{ route('blog.update', $blog->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <th scope="col" style="width:10%">Blog Name</th>
                            <td><input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? ucfirst($blog->title) }}">
                                @if ($errors->has('title'))
                                    @foreach ($errors->get('title') as $error)
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:10%">Blog Content</th>
                        <td><textarea name="content" id="file-picker">{{ old('content') ?? ucfirst($blog->content) }}</textarea>
                            @if ($errors->has('content'))
                                @foreach ($errors->get('content') as $error)
                                    <div class="alert alert-danger">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="borderless" colspan="2" style="text-align: right; border: none !important;"><button type="submit" class="btn btn-dark">UPDATE</button>&nbsp;&nbsp;<button type="reset" class="btn btn-warning">RESET</button></th>
                        </form>
                    </tr>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.8 -->
    </div>
    <script src="https://cdn.tiny.cloud/1/1tf6nfno3yi47i0rna6sogpqmrg2v0f8w12xpt60aegwbhq6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#file-picker',
            menubar: false,
            plugins: 'image table visualblocks wordcount',
            toolbar: 'undo redo | bold italic underline strikethrough | | alignleft aligncenter alignright alignjustify | numlist bullist | image table',
            images_file_types: 'jpg,png',
            //images_upload_url: 'upload.php',
            /*
            URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
            images_upload_url: 'postAcceptor.php',
            here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                /*
                  Note: In modern browsers input[type="file"] is functional without
                  even adding it to the DOM, but that might not be the case in some older
                  or quirky browsers like IE, so you might want to add it to the DOM
                  just in case, and visually hide it. And do not forget do remove it
                  once you do not need it anymore.
                */

                input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection



