@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <h3>Stock List
                    <a href="{{route('add_stock')}}" class="btn btn-sm bg-purple pull-right"><span class="fa fa-plus"></span> Stock Entry</a></h3>
            </div>
            @include('partials/messages')
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Stock name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $key => $stock)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$stock->product()->first()->product_with_brand()}}</td>
                            <td>{{$stock->quantity_with_unit()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="box">
            <div class="box-header">
                <h3>Unusable Stock List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Stock name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unusable_stocks as $key => $stock)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$stock->product()->first()->product_with_brand()}}</td>
                            <td>{{$stock->quantity_with_unit()}}</td>
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