@extends('layout')
@section('after_style')
@endsection

@section('content')

<div class='box'>
    <div class="box-header">
        <h1><i class='fa fa-key'></i> Edit Role: {{$role->name}}</h1>
        <hr>
    </div>
    @include('partials/messages')
    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', 'Role Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <h5><b>Assign Permissions</b></h5>
        @foreach ($permissions as $permission)

        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
        {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

        @endforeach
        <br>
    </div>    
    <div class="box-footer">

        {{ Form::submit('Update', array('class' => 'btn btn-success')) }}
        <a href="{{route('roles.index')}}" class="btn btn-default">Cancel</a>
    </div>

    {{ Form::close() }}
</div>

@endsection