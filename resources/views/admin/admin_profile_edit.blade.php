@extends('admin.admin_master')
@section('admin-main-content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">

                    <h4 class="text-muted font-size-16 mt-3 ms-4"><b>Edit Profile Page</b></h4>

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

                        <form method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data" class="form-horizontal">
                            @csrf

                            <div class="form-group mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label" >Name</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id" value="{{ $adminData->id }}">
                                    <input id="name" class="form-control" type="text" name="name" value="{{ $adminData->name }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label" >Email</label>
                                <div class="col-sm-10">
                                    <input id="email" class="form-control" type="email" name="email" value="{{ $adminData->email }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label" >Username</label>
                                <div class="col-sm-10">
                                    <input id="username" class="form-control" type="text" name="username" value="{{ $adminData->username }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="profile_image" class="col-sm-2 col-form-label" >Profile Image</label>
                                <div class="col-sm-10">
                                    <input id="profile_image" class="form-control" type="file" name="profile_image">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="profile_image" class="col-sm-2 col-form-label" ></label>
                                <div class="col-sm-10">
                                    <img id="show_image" src="{{ (!empty($adminData->profile_image))? asset('upload/admin_images/' . $adminData->profile_image) : asset('upload/no-image-icon.jpg') }}" alt="avatar-4" class="rounded avatar-md">
                                </div>
                            </div>

                            <div class="form-group mb-2 text-center row mt-3 pt-1 d-flex justify-content-start">
                                <div class="col-2">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Update Profile</button>
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
            $('#profile_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

@endsection
