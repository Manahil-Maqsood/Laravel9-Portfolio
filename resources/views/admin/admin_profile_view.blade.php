@extends('admin.admin_master')
@section('admin-main-content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <center>
                    <img class="rounded-circle avatar-xl mt-4" alt="200x200" src="{{ (!empty($adminData->profile_image))? asset('upload/admin_images/' . $adminData->profile_image) : asset('upload/no-image-icon.jpg') }}" data-holder-rendered="true">
                    </center>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td scope="row">Name :</td>
                                    <td>{{ $adminData->name }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Email :</td>
                                    <td>{{ $adminData->email }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Username :</td>
                                    <td>{{ $adminData->username }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-info btn-rounded waves-effect waves-light">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>

@endsection
