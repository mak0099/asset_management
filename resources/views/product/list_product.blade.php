@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <a href="{{route('add_product')}}" class="btn btn-sm bg-purple pull-right"><span class="fa fa-plus"></span> Add New Product</a>
</h1>

@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="text-right">
                    
                </div>
            </div>
            @include('partials/messages')
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product name</th>
                            <th>Model No</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Product Unit</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->model_no}}</td>
                            <td>{{$product->category_name}}</td>
                            <td>{{$product->brand_name}}</td>
                            <td>{{$product->product_unit}}</td>
                            <td>
                                @if($product->publication_status)
                                <a href="{{route('unpublish_product', ['id' => $product->id])}}"><span class="label label-success">Published</span></a>
                                @else
                                <a href="{{route('publish_product', ['id' => $product->id])}}"><span class="label label-danger">Unpublished</span></a>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('view_product',['id' => $product->id])}}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> View</a>
                                <a href="{{route('edit_product',['id' => $product->id])}}" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('delete_product',['id' => $product->id])}}" class="btn btn-default btn-xs" onclick="return confirm('Are you sure to delte this?')"><i class="fa fa-trash-o"></i> Delete</a>
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