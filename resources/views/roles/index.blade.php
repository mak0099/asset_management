@extends('layout')
@section('after_style')
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h1><i class="fa fa-key"></i> Roles

            <a href="{{ route('users.index') }}" class="btn btn-default btn-xs pull-right">Users</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default btn-xs pull-right">Permissions</a></h1>
        <hr>
    </div>
    @include('partials/messages')
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Operation</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                    <tr>

                        <td>{{ $role->name }}</td>

                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                        <td>
                            <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Add Role</a>
    </div>
    

</div>

@endsection