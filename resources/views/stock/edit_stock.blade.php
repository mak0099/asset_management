@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datepicker/datepicker3.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <!--<small>Add stock</small>-->
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
            <form role="form" action="{{route('update_stock', ['id' => $stock->id])}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-6">
                        <label>Committee No:</label>
                        <input type="text" class="form-control" placeholder="Committee No" name="committee_no" value="{{$stock->committee_no}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Procurement Date:</label>
                        <input type="text" class="form-control" id="datepicker2" placeholder="Procurement Date" name="procurement_date" value="{{$stock->procurement_date}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Select Product</label>
                        <select class="form-control select2" style="width: 100%;" name="product_id">
                            @foreach($products as $item)
                            <option value="{{$item->id}}" {{($item->id == $stock->product_id) ? 'selected': '' }}>{{$item->product_name . " (" . $item->product_brand . ")"}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Serial Number</label>
                        <input type="text" class="form-control" placeholder="Serial Number" name="serial" value="{{$stock->serial}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Price</label>
                        <input type="text" class="form-control" placeholder="Price" name="price" value="{{$stock->price}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Date</label>
                        <input type="text" class="form-control" id="datepicker" placeholder="Date" name="date" value="{{$stock->date}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Is Consumable?</label>
                        <div class="radio">
                            <label class="radio-inline"><input type="radio" name="is_consumable" value="1" {{$stock->is_consumable ? "checked":""}}>Yes</label>
                            <label class="radio-inline"><input type="radio" name="is_consumable" value="0" {{!$stock->is_consumable ? "checked":""}}>No</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Is Usable?</label>
                        <div class="radio">
                            <label class="radio-inline"><input type="radio" name="is_usable" value="1" {{$stock->is_usable ? "checked":""}}>Yes</label>
                            <label class="radio-inline"><input type="radio" name="is_usable" value="0" {{!$stock->is_usable ? "checked":""}}>No</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Attach File</label>
                        <input type="file" class="form-control" name="attach_file">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
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
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>
@endsection