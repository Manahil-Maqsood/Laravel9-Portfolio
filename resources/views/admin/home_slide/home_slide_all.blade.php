@extends('admin.admin_master')
@section('admin-main-content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">

                    <h4 class="text-muted font-size-16 mt-3 ms-4"><b>Home Slide Page</b></h4>

                    <div class="card-body">

                        <!-- Validation Errors -->
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <p><strong>Whoops! Something went wrong</strong></p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert">
                        </div>
                        @endif

                        <form method="POST" action="{{ route('update.slide') }}" enctype="multipart/form-data" class="form-horizontal">
                            @csrf

                            <div class="form-group mb-3 row">
                                <input type="hidden" name="id" value="{{ $homeslide->id }}">

                                <label for="title" class="col-sm-2 col-form-label" >Title</label>
                                <div class="col-sm-10">
                                    <input id="title" class="form-control" type="text" name="title" value="{{ $homeslide->title }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="short_title" class="col-sm-2 col-form-label" >Short Title</label>
                                <div class="col-sm-10">
                                    <input id="short_title" class="form-control" type="text" name="short_title" value="{{ $homeslide->short_title }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="video_url" class="col-sm-2 col-form-label" >Video Url</label>
                                <div class="col-sm-10">
                                    <input id="video_url" class="form-control" type="text" name="video_url" value="{{ $homeslide->video_url }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="slide_image" class="col-sm-2 col-form-label" >Slide Image</label>
                                <div class="col-sm-10">
                                    <input id="slide_image" class="form-control" type="file" name="slide_image">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="show_image" class="col-sm-2 col-form-label" ></label>
                                <div class="col-sm-10">
                                    <img id="show_image" src="{{ (!empty($homeslide->slide_img))? asset('frontend/assets/img/banner/' . $homeslide->slide_img) : asset('frontend/assets/img/banner/no_image.jpg') }}" alt="avatar-4" class="rounded avatar-md">
                                </div>
                            </div>

                            <div class="form-group mb-2 text-center row mt-3 pt-1 d-flex justify-content-start">
                                <div class="col-2">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Update Slide</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

    <script type="text/javascript">

    //Load Image
        $(document).ready(function() {
            $('#slide_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

@endsection
