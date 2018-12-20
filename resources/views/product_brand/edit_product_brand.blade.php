@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <!--<small>Add brand</small>-->
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
                    <a href="{{route('list_product_brand')}}" class="btn btn-sm bg-purple"><span class="ion-arrow-return-left"></span> Brand List</a>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('update_product_brand', ['id' => $product_brand->id])}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-12">
                        <label>Brand Name</label>
                        <input type="text" class="form-control" placeholder="Brand name" name="brand_name" value="{{$product_brand->brand_name}}">
                    </div>
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-success">Update</button>
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
                        $('#brand_unit').val('piece').attr('disabled', 'disabled');
                    }else{
                        $('#brand_unit').val('0').attr('disabled', false);
                    }
                });
    });
</script>
@endsection