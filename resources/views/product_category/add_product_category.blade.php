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
                <div>
                    <a href="{{route('list_product_category')}}" class="btn btn-sm bg-purple"><span class="ion-arrow-return-left"></span> Category List</a>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_product_category')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-12">
                        <label>Category Name</label>
                        <input type="text" class="form-control" placeholder="Category name" name="category_name" value="{{Request::old('category_name')}}">
                    </div>

                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('after_script')
@endsection