@extends('admin.admin_master')
@section('admin-main-content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">

                    <h4 class="text-muted font-size-16 mt-3 ms-4"><b>Portfolio All</b></h4>

                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Portfolio Name</th>
                                <th>Portfolio Title</th>
                                <th>Portfolio Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @php($i=1)
                            @foreach ($portfolio as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->portfolio_name }}</td>
                                <td>{{ $item->portfolio_title }}</td>
                                <td><img style="width:80px; height:50px" src="{{ asset($item->portfolio_image) }}" ></td>
                                <td>
                                    <a href="{{ route('edit.portflio.data', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit" ></i></a>
                                    <a href="{{ route('delete.portflio.data', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt" ></i></a>
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
