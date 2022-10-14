@extends('admin.admin_master')
@section('admin-main-content')

<style type="text/css">
    .bootstrap-tagsinput .tag {
      margin-right: 2px;
      color: white !important;
      background-color: #0d6efd;
      padding: 0.1rem;
      border-radius: 4px;
      font-size: 13px;
    }
</style>

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">

                    <h4 class="text-muted font-size-16 mt-3 ms-4"><b>Edit Blog Page</b></h4>

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

                        <form method="POST" action="{{ route('update.blog') }}" enctype="multipart/form-data" class="form-horizontal">
                            @csrf

                            <input id="id" class="form-control" type="text" hidden name="id" value="{{ $blogs->id }}">
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Blog Category</label>
                                <div class="col-sm-10">
                                    <select name="edit_blog_category_id" class="form-select" aria-label="Default select example">
                                        <option disabled>Select Blog Category</option>
                                        @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $blogs->blog_category_id ? "selected" : "" }} >{{ $item->blog_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="edit_blog_title" class="col-sm-2 col-form-label" >Blog Title</label>
                                <div class="col-sm-10">
                                    <input id="edit_blog_title" class="form-control" type="text" name="edit_blog_title" value="{{ $blogs->blog_title }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="edit_blog_tags" class="col-sm-2 col-form-label" >Blog Tags</label>
                                <div class="col-sm-10">
                                    <input id="edit_blog_tags" class="form-control" type="text" name="edit_blog_tags" value="{{ $blogs->blog_tags }}" data-role="tagsinput" placeholder="Add a tag... (then press comma or enter)">
                                </div>
                            </div>

                            <div class="form-group mb-4 row">
                                <label for="edit_blog_description" class="col-sm-2 col-form-label" >Blog Description</label>
                                <div class="col-sm-10">
                                    <textarea id="elm1" class="form-control" name="edit_blog_description">{{ $blogs->blog_description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group mb-4 row">
                                <label for="edit_blog_image" class="col-sm-2 col-form-label" >Blog Image</label>
                                <div class="col-sm-10">
                                    <input id="edit_blog_image" class="form-control" type="file" name="edit_blog_image">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="show_image" class="col-sm-2 col-form-label" ></label>
                                <div class="col-sm-10">
                                    <img id="show_image" style="width:10rem; height:6rem" src="{{ (!empty($blogs->blog_image))? asset($blogs->blog_image) : asset('frontend/assets/img/images/no_image.jpg') }}" alt="avatar-4" class="rounded">
                                </div>
                            </div>

                            <div class="form-group mb-2 text-center row mt-3 pt-1 d-flex justify-content-start">
                                <div class="col-3">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Update Blog Data</button>
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
            $('#edit_blog_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

@endsection
