@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('public/asset/plugins/datepicker/datepicker3.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
@endsection
@section('content_header')
<h1>
    Distribution
    <!--<small>Add medicine</small>-->
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Distribution</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <div>

                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_distribution_sub')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">

                    <div class="form-group col-sm-12">
                        <label>Date:</label>
                        <input type="text" class="form-control datepicker" placeholder="Date" name="date" value="{{date('Y-m-d', strtotime('+6 hours'))}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Select Product</label>
                        <select class="form-control select2" style="width: 100%;" name="stock_id">
                            <option disabled selected>Select Product</option>
                            @foreach($stocks as $stock)
                            <option value="{{$stock->id}}"> {{ $stock->serial}}  {{$stock->product()->first()->product_with_brand()}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Select Employee</label>
                        <select class="form-control select2" style="width: 100%;" name="employee_id">
                            <option disabled selected>Select Employee</option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->employee_name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="box">
    <div class="box-header">
        <h3>Distributed Items</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Stock name</th>
                    <th>Serial</th>
                    <th>Employee Name</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($distributions as $key => $distribution)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$distribution->stock()->product()->first()->product_with_brand()}}</td>
                    <td>{{$distribution->stock()->serial}}</td>
                    <td><a href="{{route('view_employee',['id'=>$distribution->employee()->id])}}">{{$distribution->employee()->employee_name}}</a></td>
                    <td>{{$distribution->date}}</td>

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
<script src="{{asset('public/asset/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('public/asset/plugins/select2/select2.full.min.js')}}"></script>
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
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>
@endsection