@extends('admin.admin_master')
@section('admin-main-content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">

                    <h4 class="text-muted font-size-16 mt-3 ms-4"><b>Blog All Data</b></h4>

                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Blog Category</th>
                                <th>Blog Title</th>
                                <th>Blog Tags</th>
                                <th>Blog Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @php($i=1)
                            @foreach ($blogs as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item['category']['blog_category'] }}</td>
                                <td>{{ $item->blog_title }}</td>
                                <td>{{ $item->blog_tags }}</td>
                                <td><img style="width:80px; height:50px" src="{{ asset($item->blog_image) }}" ></td>
                                <td>
                                    <a href="{{ route('edit.blog', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit" ></i></a>
                                    <a href="{{ route('delete.blog', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt" ></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
