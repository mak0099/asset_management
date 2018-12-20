@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datepicker/datepicker3.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
@endsection
@section('content_header')
<h1>
    Distribution
    <!--<small>Subunit list</small>-->
</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <div>
                    <a href="{{route('list_distribution_main')}}" class="btn btn-sm bg-purple"><span class="ion-arrow-return-left"></span>  Back</a>
                    @if($demand->has_distributed())
                    <div class="text-center">
                        <span class="alert alert-success text-bold">Demand has already distributed!</span>
                    </div>
                    @endif
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <form role="form" action="{{route('save_distribution_main', ['demand_id' => $demand->id])}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="text-align: left"><b>Demand No:</b> {{$demand->demand_no}}</td>
                            <td style="text-align: center"><b>Issue No:</b> {{$demand->demand_approval()->first()->issue_no}}</td>
                            <td style="text-align: center"><b>Unit Name:</b> {{$demand->unit()->unit_name}}</td>
                            <td style="text-align: right"><b>Unit Phone:</b> {{$demand->unit()->phone}}</td>
                        </tr>
                    </table><br>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Distribution Date</label>
                        <div class="col-sm-10">
                            @if($demand->has_distributed())
                            <input type="text" class="form-control datepicker" name="distribution_date" value="{{$demand->demand_distribution()->first()->distribution_date}}" disabled>
                            @else
                            <input type="text" class="form-control datepicker" name="distribution_date" value="{{date("Y-m-d", strtotime('+6 hours'))}}" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Employee Name</label>
                        <div class="col-sm-10">
                            @if($demand->has_distributed())
                            <input type="text" class="form-control" value="{{App\Employee::find($demand->demand_distribution->first()->employee_id)->employee_name}}" disabled>
                            @else
                            <select class="form-control select2" name="employee_id" required>
                                <option disabled selected>Select Employee</option>
                                @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->employee_name}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    <table class="table table-bordered">
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
                                <td>{{$item->product()->product_with_brand()}}</td>
                                <td>{{$item->demand_stock() . ' ' . $item->product()->product_unit}}</td>
                                <td>{{$item->quantity . ' ' . $item->product()->product_unit}}</td>
                                <td>
                                    {{$quantity = $item->approved_item()->quantity}}
                                    {{$item->product()->product_unit}}
                                </td>
                                <td>{{$item->main_stock() . ' ' . $item->product()->product_unit}}</td>
                            </tr>
                            @if($item->product()->has_serial)
                            @for($i=0; $i<$quantity; $i++)
                            <tr>
                                <td></td>
                                <td class="text-right" colspan="3">Serial-{{$i+1}}</td>
                                <td>
                                    @if($demand->has_distributed())
                                    <input type="text" class="form-control" name="{{$item->product_id}}[]" value="{{unserialize($demand->demand_distribution()->first()->distribution_items()->where('product_id', $item->product_id)->first()->serial)[$i]}}" disabled>
                                    @else
                                    <select class="select2" name="{{$item->product_id}}[]" required style="width: 100%">
                                        <option disabled selected>Select Serial</option>
                                        @foreach($item->stocks()->where('stock_owner', 1)->get() as $stock)
                                        <option value="{{$stock->serial}}">{{$stock->serial}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </td>
                            </tr>
                            @endfor
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                @if(!$demand->has_distributed())
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
@section('after_script')
<script src="{{asset('public/asset/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('public/asset/plugins/select2/select2.full.min.js')}}"></script>
<script>
$(function () {
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>
<script>
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