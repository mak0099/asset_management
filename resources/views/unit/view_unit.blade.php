@extends('layout')
@section('after_style')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <h3>View Unit<a href="{{route('list_unit')}}" class="btn btn-sm bg-purple pull-right"><span class="ion-arrow-return-left"></span> Unit List</a></h3>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Unit Name</th>
                                <td>{{$unit->unit_name}}</td>
                            </tr>
                            <tr>
                                <th>Area Code</th>
                                <td>{{$unit->area_code}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$unit->phone}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$unit->email}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{$unit->address}}</td>
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