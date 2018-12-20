@extends('layout')
@section('after_style')
@endsection

@section('content')

<div class="box">
    <div class="box-header">
        <h1><i class="fa fa-key"></i>Available Permissions

            <a href="{{ route('users.index') }}" class="btn btn-default btn-xs pull-right">Users</a>
            <a href="{{ route('roles.index') }}" class="btn btn-default btn-xs pull-right">Roles</a></h1>
        <hr>
    </div>
    @include('partials/messages')
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Permissions</th>
                        <th>URL</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td> 
                        <td>{{ $permission->url }}</td> 
                        <td>
                            <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
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
        <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Add Permission</a>
    </div>

</div>

@endsection