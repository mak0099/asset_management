@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <h3>Employee List <a href="{{route('add_employee')}}" class="btn btn-sm bg-purple pull-right"><span class="fa fa-plus"></span> Add Employee</a></h3>
            </div>
            @include('partials/messages')
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped data-table" style="min-width: 500px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee name</th>
                            <th>Designation</th>
                            <th>Unit Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $key => $employee)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$employee->employee_name}}</td>
                            <td>{{$employee->designation}}</td>
                            <td><a href="{{route('view_unit',['id'=>$employee->unit()->id])}}">{{$employee->unit()->unit_name}}</a></td>
                            <td>
                                @if($employee->publication_status)
                                <a href="{{route('unpublish_employee', ['id' => $employee->id])}}"><span class="label label-success">Published</span></a>
                                @else
                                <a href="{{route('publish_employee', ['id' => $employee->id])}}"><span class="label label-danger">Unpublished</span></a>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('view_employee',['id' => $employee->id])}}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> View</a>
                                <a href="{{route('edit_employee',['id' => $employee->id])}}" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('delete_employee',['id' => $employee->id])}}" class="btn btn-default btn-xs" onclick="return confirm('Are you sure to delte this?')"><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
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
                                            "autoWidth": false
                                        });
                                    });
</script>
@endsection