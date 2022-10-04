@extends('admin.admin_master')
@section('admin-main-content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">

                    <h4 class="text-muted font-size-16 mt-3 ms-4"><b>Change Password Page</b></h4>

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

                        <form method="POST" action="{{ route('update.password') }}" class="form-horizontal">
                            @csrf

                            <div class="form-group mb-3 row">
                                <label for="old_password" class="col-sm-2 col-form-label" >Old Password</label>
                                <div class="col-sm-10">
                                    <input id="old_password" class="form-control" type="password" name="old_password" placeholder="old password" value="">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="new_password" class="col-sm-2 col-form-label" >New Password</label>
                                <div class="col-sm-10">
                                    <input id="new_password" class="form-control" type="password" name="new_password" placeholder="new password" value="">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="confirm_password" class="col-sm-2 col-form-label" >Confirm Password</label>
                                <div class="col-sm-10">
                                    <input id="confirm_password" class="form-control" type="password" name="confirm_password" placeholder="confirm password" value="">
                                </div>
                            </div>


                            <div class="form-group mb-2 text-center row mt-3 pt-1 d-flex justify-content-start">
                                <div class="col-2">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Change Password</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection
