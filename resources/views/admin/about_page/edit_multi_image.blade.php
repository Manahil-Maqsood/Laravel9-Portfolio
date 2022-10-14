@extends('admin.admin_master')
@section('admin-main-content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">

                    <h4 class="text-muted font-size-16 mt-3 ms-4"><b>Update Multi Page</b></h4>

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

                        <form method="POST" action="{{ route('update.multi.image') }}" enctype="multipart/form-data" class="form-horizontal">
                            @csrf

                            <input id="id" class="form-control" type="text" hidden name="id" value="{{ $multiImageData->id }}">

                            <div class="form-group mb-4 row">
                                <label for="update_multi_image" class="col-sm-2 col-form-label" >Update Multi Image</label>
                                <div class="col-sm-10">
                                    <input id="update_multi_image" class="form-control" type="file" name="update_multi_image">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="show_image" class="col-sm-2 col-form-label" ></label>
                                <div class="col-sm-10">
                                    <img id="show_image" src="{{ (!empty($multiImageData->multi_image))? asset($multiImageData->multi_image) : asset('frontend/assets/img/images/no_image.jpg') }}" alt="avatar-4" class="rounded avatar-lg">
                                </div>
                            </div>

                            <div class="form-group mb-2 text-center row mt-3 pt-1 d-flex justify-content-start">
                                <div class="col-3">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Update Multi Image</button>
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
            $('#update_multi_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

@endsection
