@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datepicker/datepicker3.css')}}">
@endsection
@section('content_header')
<h1>
    Demand Approval
    <!--<small>Subunit list</small>-->
</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <div>
                    <a href="{{route('demand_request_main')}}" class="btn btn-sm bg-purple"><span class="ion-arrow-return-left"></span>  Back</a>
                    @if($demand->has_approved())
                    <div class="text-center">
                        <span class="alert alert-success text-bold">Demand has already approved!</span>
                    </div>
                    @endif
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <form role="form" action="{{route('save_demand_approval', ['demand_no' => $demand->id])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="text-align: left"><b>Demand No:</b> {{$demand->demand_no}}</td>
                            <td style="text-align: right"><b>Unit Name:</b> {{$demand->unit()->unit_name}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><b>Demand Date:</b> {{$demand->date}}</td>
                            <td style="text-align: right"><b>Phone Number:</b> {{$demand->unit()->phone}}</td>
                        </tr>
                    </table><br>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Issue No</label>
                        <div class="col-sm-10">
                            @if($demand->has_approved())
                            <input type="text" class="form-control" name="issue_no" value="{{$demand_approval->issue_no}}" disabled>
                            @else
                            <input type="text" class="form-control" name="issue_no" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Issue Date</label>
                        <div class="col-sm-10">
                            @if($demand->has_approved())
                            <input type="text" class="form-control datepicker" name="issue_date" value="{{$demand_approval->issue_date}}" disabled>
                            @else
                            <input type="text" class="form-control datepicker" name="issue_date" required>
                            @endif
                        </div>
                    </div>
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>On Stock</th>
                                <th>Demand</th>
                                <th>Distribution</th>
                                <th>Main Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($demand_items as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->product()->product_name}} {{$item->product()->product_brand ? '('.$item->product()->product_brand.')':'' }}</td>
                                <td>{{$item->demand_stock() . ' ' . $item->product()->product_unit}}</td>
                                <td>{{$item->quantity . ' ' . $item->product()->product_unit}}</td>
                                <td class="input-group">
                                    @if($demand->has_approved())
                                    <input type="number" name="{{$item->product_id}}" class="form-control" value="{{$demand_approval->getItemByProductId($item->product_id)->quantity}}" disabled>
                                    @else
                                    <input type="number" name="{{$item->product_id}}" class="form-control" required min="0">
                                    @endif
                                    <span class="input-group-addon">{{$item->product()->product_unit}}</span>
                                </td>
                                <td>{{$item->main_stock() . ' ' . $item->product()->product_unit}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group col-sm-12">
                        <label>Attach File</label>
                        @if($demand->has_approved() && $demand_approval->file_name)
                        <a href="{{asset($demand_approval->file_name)}}" class="form-control" title="Download">Download</a>
                        @else
                        <input type="file" class="form-control" name="attach_file">
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
                @if(!$demand->has_approved())
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Approve</button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
@section('after_script')
<script src="{{asset('public/asset/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script>
$(function () {
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
});
//    $(function () {
//        $('.quantity').on('keyup', function () {
//            var hasSerial = $(this).attr('has-serial');
//            if(hasSerial == 1){
//                var name = $(this).attr('name');
//            var quantity = $(this).val();
//            $('.serial'+name).remove();
//            $(this).parent('td').parent('tr').after(function () {
//                var x = '';
//                for (var i = 1; i <= quantity; i++) {
//                    x += '<tr class="serial'+name+'">';
//                    x += '<td colspan="4" align="right">Serial-'+ i +'</td>';
//                    x += '<td><input type="text" class="form-control" name="serial'+name+'[]"></td>';
//                    x += '<td></td>';
//                    x += '</tr>';
//                }
//                return x;
//            });
//            }
//        });
//    });
</script>
@endsection