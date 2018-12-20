@extends('layout')
@section('after_style')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <div>
                    <h3>Add Unit<a href="{{route('list_unit')}}" class="btn btn-sm bg-purple pull-right"><span class="ion-arrow-return-left"></span> Unit List</a></h3>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_unit')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-12">
                        <label>Unit Name</label>
                        <input type="text" class="form-control" placeholder="Unit name" name="unit_name" value="{{Request::old('unit_name')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Area Code</label>
                        <input type="text" class="form-control" placeholder="Area code" name="area_code" value="{{Request::old('area_code')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" placeholder="Phone number" name="phone" value="{{Request::old('phone')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{Request::old('email')}}">
                    </div>
                    <!-- <div class="form-group col-sm-12"> -->
                        <!-- <label>Unit Type</label> -->
                        <input type="hidden" class="form-control" placeholder="Unit Type" name="unit_type" value="Sub Unit">
                    <!-- </div> -->
                    <div class="form-group col-sm-12">
                        <label>Address</label>
                        <textarea class="form-control" name="address">{{Request::old('address')}}</textarea>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{route('list_unit')}}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('after_script')

@endsection