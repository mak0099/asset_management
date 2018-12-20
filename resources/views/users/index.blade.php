@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h1><i class="fa fa-users"></i> User Administration <a href="{{ route('roles.index') }}" class="btn btn-default btn-xs pull-right">Roles</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default btn-xs pull-right">Permissions</a></h1>
        <hr>
    </div>
    @include('partials/messages')
    <div class="box-body">
        <table class="table table-bordered table-striped data-table">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Unit</th>
                    <th>User Roles</th>
                    <th>Operations</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ str_replace(['[', ']', '"'], '', $user->branch()->pluck('unit_name')) }}</td>
                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <div class="box-footer">
        <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
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