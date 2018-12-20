@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h3>Stock</h3>
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
                @foreach($product_stocks as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->product()->first()->product_with_brand()}}</td>
                    <td>{{$item->quantity_with_unit()}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<div class="box">
    <div class="box-header">
        <h3>Individual Stock</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Stock name</th>
                    <th>Serial</th>
                    <th>File</th>
                    <th>Quantity</th>
                    <th>Committee No</th>
                    <th>Procurement Date</th>
                    <th>Date</th>
                    <th>Hand on</th>
                </tr>
            </thead>
            <tbody>
                @foreach($individual_stocks as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->product()->first()->product_with_brand()}}</td>
                    <td>{{$item->serial}}</td>
                    <td>@if($item->file_name)<a href="{{$item->file_name}}" title="Download File"><i class="fa fa-paperclip fa-2x"></i></a>@endif</td>
                    <td>{{$item->quantity_with_unit()}}</td>
                    <td>{{$item->committee_no}}</td>
                    <td>{{$item->procurement_date}}</td>
                    <td>{{$item->date}}</td>
                    <td>
                        @if($item->in_stock)
                        <span class="text-success">In Stock</span>
                        @else
                        <a href="{{route('view_employee',['id'=>$item->distribution_sub()->first()->employee_id])}}">{{$item->distribution_sub()->first()->employee()->employee_name}}</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
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