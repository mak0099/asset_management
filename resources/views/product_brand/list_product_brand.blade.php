@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <!--<small>Brand list</small>-->
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{$heading}}</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="text-right">
                    <a href="{{route('add_product_brand')}}" class="btn btn-sm bg-purple"><span class="fa fa-plus"></span> Add New Brand</a>
                </div>
            </div>
            @include('partials/messages')
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Brand name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product_brands as $key => $brand)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$brand->brand_name}}</td>
                            <td>
                                @if($brand->publication_status)
                                <a href="{{route('unpublish_product_brand', ['id' => $brand->id])}}"><span class="label label-success">Published</span></a>
                                @else
                                <a href="{{route('publish_product_brand', ['id' => $brand->id])}}"><span class="label label-danger">Unpublished</span></a>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('edit_product_brand',['id' => $brand->id])}}" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('delete_product_brand',['id' => $brand->id])}}" class="btn btn-default btn-xs" onclick="return confirm('Are you sure to delte this?')"><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
@section('after_script')
<script src="{{asset('public/asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
                                    $(function () {
                                        $('.data-table').DataTable({
                                            "paging": true,
                                            "lengthChange": false,
                                            "searching": true,
                                            "ordering": true,
                                            "info": true,
                                            "autoWidth": false
                                        });
                                    });
</script>
@endsection