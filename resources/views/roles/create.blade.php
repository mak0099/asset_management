@extends('layout')
@section('after_style')
@endsection

@section('content')

<div class='box'>

    <div class="box-header">
        <h1><i class='fa fa-key'></i> Add Role</h1>
        <hr>
    </div>
    @include('partials/messages')
    {{ Form::open(array('url' => 'roles')) }}
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <h5><b>Assign Permissions</b></h5>

        <div class='form-group'>
            @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

            @endforeach
        </div>
    </div>
    <div class="box-footer">

        {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
        <a href="{{route('roles.index')}}" class="btn btn-default">Cancel</a>
    </div>

    {{ Form::close() }}

</div>

@endsection