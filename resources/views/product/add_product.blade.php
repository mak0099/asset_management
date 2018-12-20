@extends('layout')
@section('after_style')
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
                    <a href="{{route('list_product')}}" class="btn btn-sm bg-purple"><span class="ion-arrow-return-left"></span> Product List</a>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_product')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-12">
                        <label>Product Name</label>
                        <input type="text" class="form-control" placeholder="Product name" name="product_name" value="{{Request::old('product_name')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Model Number</label>
                        <input type="text" class="form-control" placeholder="Model No" name="model_no" value="{{Request::old('model_no')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Select Product Brand</label>
                        <select class="form-control select2" style="width: 100%;" name="brand_id" id="product_id">
                            <option value="0" selected>Select Brand</option>
                            @foreach($product_brands as $product_brand)
                            <option value="{{$product_brand->id}}">{{$product_brand->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Select Product Category</label>
                        <select class="form-control select2" style="width: 100%;" name="category_id" id="product_id">
                            @foreach($product_categories as $product_category)
                            <option value="{{$product_category->id}}">{{$product_category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Product has Serial?</label>
                        <div class="radio">
                            <label class="radio-inline"><input type="radio" name="has_serial" value="1">Yes</label>
                            <label class="radio-inline"><input type="radio" name="has_serial" value="0">No</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Select Measuring Unit</label>
                        <select class="form-control" style="width: 100%;" name="product_unit" id="product_unit" disabled>
                            <option disabled selected value="0">Select Product Unit</option>
                            <option>piece</option>
                            <option>feet</option>
                            <option>meter</option>
                            <option>kg</option>
                        </select>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('after_script')
<script src="{{asset('public/asset/plugins/select2/select2.full.min.js')}}"></script>
<script>
    $(function () {
        $(".select2").select2();
        $('input:radio[name="has_serial"]').change(
                function () {
                    if ($(this).is(':checked') && $(this).val() == 1) {
                        $('#product_unit').val('piece').attr('disabled', 'disabled');
                    }else{
                        $('#product_unit').val('0').attr('disabled', false);
                    }
                });
    });
</script>
@endsection