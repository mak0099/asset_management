@extends('layout')
@section('after_style')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <h3>View Product<a href="{{route('list_product')}}" class="btn btn-sm bg-purple pull-right"><span class="ion-arrow-return-left"></span> Product List</a></h3>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Product name</th>
                                <td>{{$product->product_name}}</td>
                            </tr>
                            <tr>
                                <th>Model No</th>
                                <td>{{$product->model_no}}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{$product->category_name}}</td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td>{{$product->brand_name}}</td>
                            </tr>
                            <tr>
                                <th>Product Unit</th>
                                <td>{{$product->product_unit}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <a href="{{URL::previous()}}" class="btn btn-default btn-xs">Back</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
@section('after_script')
@endsection