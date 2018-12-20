@extends('layout')
@section('after_style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <h3>Add Employee<a href="{{route('list_employee')}}" class="btn btn-sm bg-purple pull-right"><span class="ion-arrow-return-left"></span> Employee List</a></h3>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_employee')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    @if(Auth::user()->unit_id() == 1)
                    <div class="form-group col-sm-12">
                        <label>Select Unit Name</label>
                        <select class="form-control select2" name="unit_id">
                            <option disabled selected>Select Unit Name</option>
                            @foreach($units as $unit)
                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <input type="hidden" name="unit_id" value="{{Auth::user()->unit_id()}}">
                    @endif
                    <div class="form-group col-sm-12">
                        <label>Employee Name</label>
                        <input type="text" class="form-control" placeholder="Employee name" name="employee_name" value="{{Request::old('employee_name')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Employee Id</label>
                        <input type="text" class="form-control" placeholder="Employee id" name="employee_id" value="{{Request::old('employee_id')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Designation</label>
                        <input type="text" class="form-control" placeholder="Designation" name="designation" value="{{Request::old('designation')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" placeholder="Phone number" name="phone" value="{{Request::old('phone')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{Request::old('email')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Address</label>
                        <textarea class="form-control" name="address">{{Request::old('address')}}</textarea>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{route('list_employee')}}" class="btn btn-default">Cancel</a>
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
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>
@endsection