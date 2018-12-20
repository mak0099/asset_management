@extends('layout')
@section('after_style')
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h3>On Demand Report</h3>
    </div>
    @include('partials/messages')
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
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
                    <td>{{$item->stock() - $item->quantity . ' ' . $item->product()->product_unit}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!--<div class="box">
    <div class="box-header">
        <h3>Demand Requests</h3>
    </div>
    @include('partials/messages')
     /.box-header 
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
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
                        <a href="{{route('view_demand', ['demand_no' => $demand->demand_no])}}" class="btn btn-success btn-sm" title="View">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>-->
    <!-- /.box-body -->
</div>
@endsection
@section('after_script')

@endsection