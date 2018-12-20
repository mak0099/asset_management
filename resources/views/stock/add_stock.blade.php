@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datepicker/datepicker3.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <!--<small>Add medicine</small>-->
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">{{$heading}}</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <div>
                    <a href="{{route('list_stock')}}" class="btn btn-sm bg-purple"><span class="ion-arrow-return-left"></span> Stock List</a>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_stock')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-6">
                        <label>Committee No:</label>
                        <input type="text" class="form-control" placeholder="Committee No" name="committee_no" value="{{$stock ? $stock->committee_no : ''}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Procurement Date:</label>
                        <input type="text" class="form-control" id="datepicker2" placeholder="Procurement Date" name="procurement_date" value="{{$stock ? $stock->procurement_date : ''}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Select Product</label>
                        <select class="form-control select2" style="width: 100%;" name="product_id" id="product_id">
                            @if($stock)
                            @foreach($products as $product)
                            <option value="{{$product->id}}" {{($product->id == $stock->product_id) ? 'selected': '' }}>{{$product->product_with_brand()}}</option>
                            @endforeach
                            @else
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{ $product->product_with_brand()}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-sm-12" id="serial">
                        <label>Serial Number</label>
                        <input type="text" class="form-control" placeholder="Serial Number" name="serial" value="{{$stock ? $stock->serial : ''}}">
                    </div>
                    <div class="form-group col-sm-12" id="quantity">
                        <label>Quantity</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="quantity">
                            <div class="input-group-addon">
                                <span id="unit"></span>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Price</label>
                        <input type="text" class="form-control" placeholder="Price" name="price" value="{{$stock ? $stock->price : ''}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Date</label>
                        <input type="text" class="form-control" id="datepicker1" placeholder="Date" name="date" value="<?php echo date("Y-m-d", strtotime('+6 hours')); ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Is Consumable?</label>
                        <div class="radio">
                            @if($stock)
                            <label class="radio-inline"><input type="radio" name="is_consumable" value="1" {{$stock->is_consumable ? "checked":""}}>Yes</label>
                            <label class="radio-inline"><input type="radio" name="is_consumable" value="0" {{!$stock->is_consumable ? "checked":""}}>No</label>
                            @else
                            <label class="radio-inline"><input type="radio" name="is_consumable" value="1">Yes</label>
                            <label class="radio-inline"><input type="radio" name="is_consumable" value="0">No</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Is Usable?</label>
                        <div class="radio">
                            @if($stock)
                            <label class="radio-inline"><input type="radio" name="is_usable" value="1" {{$stock->is_usable ? "checked":""}}>Yes</label>
                            <label class="radio-inline"><input type="radio" name="is_usable" value="0" {{!$stock->is_usable ? "checked":""}}>No</label>
                            @else
                            <label class="radio-inline"><input type="radio" name="is_usable" value="1">Yes</label>
                            <label class="radio-inline"><input type="radio" name="is_usable" value="0">No</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Attach File</label>
                        <input type="file" class="form-control" name="attach_file">
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
        <div class="box">
            <div class="box-header">
                <h3>Stock Items List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Stock name</th>
                            <th>Serial</th>
                            <th>File</th>
                            <th>Price</th>
                            <th>Committee No</th>
                            <th>Procurement Date</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $key => $stock)
                        <?php $product_name = App\Product::find($stock->product_id)->product_name; ?>
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$product_name}}</td>
                            <td>{{$stock->serial}}</td>
                            <td>@if($stock->file_name)<a href="{{$stock->file_name}}" title="Download File"><i class="fa fa-paperclip fa-2x"></i></a>@endif</td>
                            <td>{{$stock->price}}</td>
                            <td>{{$stock->committee_no}}</td>
                            <td>{{$stock->procurement_date}}</td>
                            <td>{{$stock->date}}</td>
                            <td>
                                @if($stock->publication_status)
                                <a href="{{route('unpublish_stock', ['id' => $stock->id])}}"><span class="label label-success">Published</span></a>
                                @else
                                <a href="{{route('publish_stock', ['id' => $stock->id])}}"><span class="label label-danger">Unpublished</span></a>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('edit_stock',['id' => $stock->id])}}" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('delete_stock',['id' => $stock->id])}}" class="btn btn-default btn-xs" onclick="return confirm('Are you sure to delte this?')"><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
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
<script src="{{asset('public/asset/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('public/asset/plugins/select2/select2.full.min.js')}}"></script>
<script>
                                    $(function () {
                                        $('#datepicker1').datepicker({
                                            autoclose: true,
                                            format: 'yyyy-mm-dd'
                                        });
                                        $('#datepicker2').datepicker({
                                            autoclose: true,
                                            format: 'yyyy-mm-dd'
                                        });
                                        //Initialize Select2 Elements
                                        $(".select2").select2();
                                    });
</script>
<script>
    $(function () {
        var product_id = $('#product_id').val();
        serialOrQuantity(product_id);
        $("#product_id").change(function () {
            var product_id = $(this).val();
            serialOrQuantity(product_id);
        });
    });
    function serialOrQuantity(product_id) {
        $.ajax({url: "{{URL::to('product/get-product-by-id')}}/" + product_id, success: function (result) {
                if (result.has_serial) {
                    $('#serial').show();
                    $('#quantity').hide();
                    $('#quantity input').val(1);
                } else {
                    $('#serial').hide();
                    $('#quantity').show();
                    $('#quantity input').val(null);
                }
                $('#unit').text(result.product_unit);
            }});
    }
</script>
@endsection