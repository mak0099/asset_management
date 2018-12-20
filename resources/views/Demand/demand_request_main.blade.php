@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h3>Stock vs. Demand Summary</h3>
    </div>
    @include('partials/messages')
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>On Stock</th>
                    <th>On Demand</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demand_items as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->product()->product_name}}</td>
                    <td>{{$item->stock() . ' ' . $item->product()->product_unit}}</td>
                    <td>{{$item->quantity . ' ' . $item->product()->product_unit}}</td>
                    <td>{{($item->stock() - $item->quantity) . ' ' . $item->product()->product_unit}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<div class="box">
    <div class="box-header">
        <h3>Demand Requests</h3>
    </div>
    @include('partials/messages')
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Demand No</th>
                    <th>Unit Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demands as $key => $demand)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$demand->demand_no}}</td>
                    <td>{{$demand->unit()->unit_name}}</td>
                    <td>{{$demand->date}}</td>
                    <td>
                        <a href="{{route('view_demand', ['demand_no' => $demand->demand_no])}}" class="btn btn-warning btn-sm" title="View">View</a>
                        @if($demand->has_approved())
                        <a href="{{route('demand_approval', ['demand_no' => $demand->demand_no])}}" class="btn btn-success btn-sm">Approved</a>
                        @else
                        <a href="{{route('demand_approval', ['demand_no' => $demand->demand_no])}}" class="btn btn-primary btn-sm">Approval</a>
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
        "autoWidth": false,
    });
});
</script>
@endsection