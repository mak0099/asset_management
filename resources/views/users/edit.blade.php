@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/health/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')

<div class='box'>

    <div class="box-header">
        <h1><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h1>
        <hr>
    </div>
    @include('partials/messages')
    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>
        
        <div class="form-group">
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username', null, array('class' => 'form-control')) }}
        </div>

        <h5><b>Give Role</b></h5>

        <div class='form-group'>
            @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

            @endforeach
        </div>

        <div class="form-group">
            <label class="control-label">Select Branch</label>
            <select class="form-control select2" name="branch_id">
                @foreach($units as $unit)
                <option value="{{$unit->id}}" {{$unit->id == $branch->id ? 'selected':''}}>{{$unit->unit_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="box-footer">
        {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
        <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
    </div>

    {{ Form::close() }}

</div>

@endsection