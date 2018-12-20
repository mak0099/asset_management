@extends('layout')
@section('after_style')
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
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_product_brand')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-12">
                        <label>Brand Name</label>
                        <input type="text" class="form-control" placeholder="Brand name" name="brand_name" value="{{Request::old('brand_name')}}">
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
@endsection