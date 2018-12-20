@extends('layout')
@section('after_style')
@endsection

@section('content')

<div class='box'>
    <div class="box-header">
        <h1><i class='fa fa-key'></i> Edit {{$permission->name}}</h1>
        <br>
    </div>
    @include('partials/messages')
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('name', 'Permission Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('name', 'URL') }}
            {{ Form::text('url', null, array('class' => 'form-control')) }}
        </div><br>
        <br>
    </div>
    <div class="box-footer">

        {{ Form::submit('Edit', array('class' => 'btn btn-success')) }}
        <a href="{{route('permissions.index')}}" class="btn btn-default">Cancel</a>
    </div>

    {{ Form::close() }}

</div>

@endsection