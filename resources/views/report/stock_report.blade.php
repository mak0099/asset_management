@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/health/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <h3>On Stock Report</h3>
            </div>
            @include('partials/messages')
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
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
                            <td>{{$stock->quantity . ' ' .$stock->product()->first()->product_unit}}</td>
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
<script src="{{asset('public/health/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/health/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
                                    $(function () {
                                        $("#example1").DataTable();
                                        $('#example2').DataTable({
                                            "paging": true,
                                            "lengthChange": false,
                                            "searching": false,
                                            "ordering": true,
                                            "info": true,
                                            "autoWidth": false
                                        });
                                    });
</script>
@endsection