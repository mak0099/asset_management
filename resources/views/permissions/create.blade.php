@extends('layout')
@section('after_style')
@endsection

@section('content')

<div class='box'>

    <div class="box-header">
        <h1><i class='fa fa-key'></i> Add Permission</h1>
        <br>
    </div>
    @include('partials/messages')
    {{ Form::open(array('url' => 'permissions')) }}
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('name', 'URL') }}
            {{ Form::text('url', '', array('class' => 'form-control')) }}
        </div><br>
        @if(!$roles->isEmpty())
        <h4>Assign Permission to Roles</h4>

        @foreach ($roles as $role) 
        {{ Form::checkbox('roles[]',  $role->id ) }}
        {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
        @endif
        <br>
    </div>
    <div class="box-footer">
        {{ Form::submit('Add', array('class' => 'btn btn-success')) }}
        <a href="{{route('permissions.index')}}" class="btn btn-default">Cancel</a>

    </div>
    {{ Form::close() }}

</div>

@endsection