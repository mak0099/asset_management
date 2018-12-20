@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datepicker/datepicker3.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h3>Distribution Report</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped data-table" style="min-width: 500px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Stock name</th>
                    <th>Serial</th>
                    <th>Employee Name</th>
                    <th>Unit Name</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($distributions as $key => $distribution)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$distribution->stock()->product()->first()->product_with_brand()}}</td>
                    <td>{{$distribution->stock()->serial}}</td>
                    <td><a href="{{route('view_employee',['id'=>$distribution->employee_id])}}">{{$distribution->employee()->employee_name}}</a></td>
                    <td>
                        @if(Auth::user()->unit_type() == 'Main Unit')
                            <a href="{{route('view_unit',['id'=>$distribution->unit_id])}}">{{$distribution->unit()->unit_name}}</a>
                        @else
                        {{$distribution->unit()->unit_name}}
                        @endif
                    </td>
                    <td>{{date('F d, Y', strtotime($distribution->date))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
@endsection
@section('after_script')
<script src="{{asset('public/asset/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('public/asset/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('public/asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
                                    $(function () {
                                        $('.datepicker').datepicker({
                                            autoclose: true,
                                            format: 'yyyy-mm-dd'
                                        });
                                        //Initialize Select2 Elements
                                        $(".select2").select2();
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