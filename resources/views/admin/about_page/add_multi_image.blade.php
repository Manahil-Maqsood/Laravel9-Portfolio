@extends('admin.admin_master')
@section('admin-main-content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">

                    <h4 class="text-muted font-size-16 mt-3 ms-4"><b>Add Multi Image</b></h4>

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

                        <form method="POST" action="{{ route('store.multi.image') }}" enctype="multipart/form-data" class="form-horizontal">
                            @csrf

                            <div class="form-group mb-4 row">
                                <label for="multi_image" class="col-sm-2 col-form-label" >Select Multi Image</label>
                                <div class="col-sm-10">
                                    <input id="multi_image" class="form-control" type="file" name="multi_image[]" multiple="">
                                </div>
                            </div>

                            <div class="user-image mb-3 text-center">
                                <div class="imgPreview"> </div>
                            </div>

                            <div class="form-group mb-2 text-center row mt-3 pt-1 d-flex justify-content-start">
                                <div class="col-3">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Add Multi Image</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>


<script>

    $(function() {
    // Multiple images preview with JavaScript
    var multiImgPreview = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img style="padding:8px; max-width:100px" >')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#multi_image').on('change', function() {
        multiImgPreview(this, 'div.imgPreview');
    });
    });

</script>

@endsection
