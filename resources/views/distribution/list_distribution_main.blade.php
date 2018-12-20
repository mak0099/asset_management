@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h2>Distribution</h2>
    </div>
    @include('partials/messages')
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped data-table">
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
                @foreach($approved_demands as $key => $approved_demand)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$approved_demand->demand()->demand_no}}</td>
                    <td>{{$approved_demand->demand()->unit()->unit_name}}</td>
                    <td>{{$approved_demand->demand()->date}}</td>
                    <td class="btn-group">
                        @if($approved_demand->demand()->has_distributed())
                        <a href="{{route('distribution_main', ['demand_no' => $approved_demand->demand()->demand_no])}}" class="btn btn-success btn-sm">Distributed</a>
                        @else
                        <a href="{{route('distribution_main', ['demand_no' => $approved_demand->demand()->demand_no])}}" class="btn btn-primary btn-sm">Distribution</a>
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