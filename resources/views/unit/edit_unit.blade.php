@extends('layout')
@section('after_style')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <div>
                    <h3>Edit Unit<a href="{{route('list_unit')}}" class="btn btn-sm bg-purple pull-right"><span class="ion-arrow-return-left"></span> Unit List</a></h3>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('update_unit', ['id' => $unit->id])}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-6">
                        <label>Unit Name</label>
                        <input type="text" class="form-control" placeholder="Unit name" name="unit_name" value="{{$unit->unit_name}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Area Code</label>
                        <input type="text" class="form-control" placeholder="Area code" name="area_code" value="{{$unit->area_code}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" placeholder="Phone number" name="phone" value="{{$unit->phone}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{$unit->email}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Address</label>
                        <textarea class="form-control" name="address"> {{$unit->address}}</textarea>
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

@endsection