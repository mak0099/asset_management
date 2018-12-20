@extends('layout')
@section('after_style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
@endsection

@section('content')

<div class='box'>

    <div class="box-header">
        <h1><i class='fa fa-user-plus'></i> Add User</h1>
        <hr>
    </div>
    @include('partials/messages')
    {{ Form::open(array('url' => 'users')) }}
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', '', array('class' => 'form-control')) }}
        </div>
        
        <div class="form-group">
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username', '', array('class' => 'form-control')) }}
        </div>

        <div class='form-group'>
            @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

            @endforeach
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password') }}<br>
            {{ Form::password('password', array('class' => 'form-control')) }}

        </div>

        <div class="form-group">
            {{ Form::label('password', 'Confirm Password') }}<br>
            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

        </div>
        <div class="form-group">
            <label class="control-label">Select Branch</label>
            <select class="form-control select2" name="branch_id">
                @foreach($units as $unit)
                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
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

@section('after_script')
<script src="{{asset('public/asset/plugins/select2/select2.full.min.js')}}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>

@endsection