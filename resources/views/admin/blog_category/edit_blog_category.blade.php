@extends('admin.admin_master')
@section('admin-main-content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">

                    <h4 class="text-muted font-size-16 mt-3 ms-4"><b>Edit Blog Category</b></h4>

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

                        <form method="POST" action="{{ route('update.blog.category') }}" class="form-horizontal">
                            @csrf

                            <div class="form-group mb-3 row">
                                <input id="id" class="form-control" type="text" hidden name="id" value="{{ $blogCategoryData->id }}">

                                <label for="edit_blog_category" class="col-sm-2 col-form-label" >Blog Category Name</label>
                                <div class="col-sm-10">
                                    <input id="edit_blog_category" class="form-control" type="text" name="edit_blog_category" value="{{ $blogCategoryData->blog_category }}">
                                </div>
                            </div>

                            <div class="form-group mb-2 text-center row mt-3 pt-1 d-flex justify-content-start">
                                <div class="col-3">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Update Blog Category</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection
