@extends('layout')
@section('after_style')
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <!--<small>Subunit list</small>-->
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{$heading}}</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <div>
                    @if(Auth::user()->unit_type() == 'Sub Unit')
                    <a href="{{route('demand_request_sub')}}" class="btn btn-sm bg-purple"><span class="ion-arrow-return-left"></span>  Back</a>
                    @else
                    <a href="{{route('demand_request_main')}}" class="btn btn-sm bg-purple"><span class="ion-arrow-return-left"></span>  Back</a>
                    @endif
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <div id="print_area">
                    <p>To</p>
                    <p>
                        <span>Police super (Admin & Telecom)</span><br>
                        <span>Police T&IM , Rajarbag, Dhaka</span>
                    </p>
                    <p><b>Subject: Demand Letter (Radio Branch)</b></p>
                    <table width="100%">
                        <tr>
                            <td style="text-align: left"><b>Demand No:</b> {{$demand->demand_no}}</td>
                            <td style="text-align: right"><b>Date:</b> {{$demand->date}}</td>
                        </tr>
                    </table><br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>On Stock</th>
                                <th>Demand</th>
                                <th>Logical Brief</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($demand_items as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->product()->product_with_brand()}}</td>
                                <td>{{$item->stock() . ' ' . $item->product()->product_unit}}</td>
                                <td>{{$item->quantity . ' ' . $item->product()->product_unit}}</td>
                                <td>{{$item->logical_brief}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <p>Therefore, the request for the necessary arrangement for the goods mentioned in the above table is requested.</p><br><br><br><br><br>
                    <table width="100%">
                        <tr>
                            <td style="text-align: left">Signature / OC</td>
                            <td style="text-align: right">Signature / Police Super</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
                <a href="" class="btn btn-lg bg-purple" onclick="print_content()"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('after_script')
<script>
    function print_content() {
        var restore_page = document.body.innerHTML;
        document.body.style.fontSize = '14px';
        document.getElementById('print_area').style.width = '100px';
        document.getElementById('print_area').style.height = '200px';
        var print_content = document.getElementById('print_area').innerHTML;
        document.body.innerHTML = print_content;
        window.print();
        document.body.innerHTML = restore_page;
    }
</script>
@endsection