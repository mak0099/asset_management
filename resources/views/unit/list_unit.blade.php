@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <h3>Unit List <a href="{{route('add_unit')}}" class="btn btn-sm bg-purple pull-right"><span class="fa fa-plus"></span> Add Sub Unit</a></h3>
            </div>
            @include('partials/messages')
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Unit name</th>
                            <th>Area Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($units as $key => $unit)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$unit->unit_name}}</td>
                            <td>{{$unit->area_code}}</td>
                            @if($unit->unit_type == 'Sub Unit')
                            <td>
                                @if($unit->publication_status)
                                <a href="{{route('unpublish_unit', ['id' => $unit->id])}}"><span class="label label-success">Published</span></a>
                                @else
                                <a href="{{route('publish_unit', ['id' => $unit->id])}}"><span class="label label-danger">Unpublished</span></a>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('view_unit',['id' => $unit->id])}}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> View</a>
                                <a href="{{route('edit_unit',['id' => $unit->id])}}" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('delete_unit',['id' => $unit->id])}}" class="btn btn-default btn-xs" onclick="return confirm('Are you sure to delte this?')"><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
                            @else
                            <td>
                                <span class="label label-success">Published</span>

                            </td>
                            <td>
                                <a href="{{route('view_unit',['id' => $unit->id])}}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> View</a>
                                <a href="{{route('edit_unit',['id' => $unit->id])}}" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit</a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
@section('after_script')
<script src="{{asset('public/asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
                                    $(function () {
                                        $('.data-table').DataTable({
                                            "paging": true,
                                            "lengthChange": false,
                                            "searching": true,
                                            "ordering": true,
                                            "info": true,
                                            "autoWidth": false,
                                        });
                                    });
</script>
@endsection