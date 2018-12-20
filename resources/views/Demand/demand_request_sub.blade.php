@extends('layout')
@section('after_style')
@endsection


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <div>
                    <h3>Demand Request</h3>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_pre_demand')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label>Select Product</label>
                        <select class="form-control select2" style="width: 100%;" name="product_id" id="product_id">
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->product_with_brand()}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <div class="input-group">
                            <input type="number" min="1" class="form-control" placeholder="Quantity" name="quantity" id="quantity">
                            <span class="input-group-addon" id="unit"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Logical Brief</label>
                        <input type="text" class="form-control" placeholder="Logical Brief" name="logical_brief">
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="box">
            <div class="box-header">
                <div class="text-right">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>On Stock</th>
                            <th>Quantity</th>
                            <th>Logical Brief</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pre_demands as $key => $pre_demand)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$pre_demand->product()->product_with_brand()}}</td>
                            <td>{{$pre_demand->stock_with_unit()}}</td>
                            <td>{{$pre_demand->quantity_with_unit()}}</td>
                            <td>{{$pre_demand->logical_brief}}</td>
                            <td>
                                <a href="{{route('remove_pre_demand_item', ['id' => $pre_demand->id])}}" class="btn btn-danger btn-sm" title="Remove"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
                <a href="{{route('remove_pre_demand')}}" class="btn btn-danger">Remove All</a>
                <a href="{{route('save_demand')}}" class="btn btn-success">Confirm Request</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('after_script')
<script>
    $(function () {
        var product_id = $('#product_id').val(); 
        getUnit(product_id);
        $("#product_id").change(function () {
            var product_id = $(this).val();
            getUnit(product_id);
        });
    });
    function getUnit(product_id) {
        $.ajax({url: "{{URL::to('product/get-product-by-id')}}/"+product_id, success: function (result) {
                $('#unit').text(result.product_unit);
            }});
    }
</script>
@endsection