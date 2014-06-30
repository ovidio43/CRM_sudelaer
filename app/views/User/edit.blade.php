@extends('sidebar')
@section('title')
Edit User
@stop
@section('content')
<?php
$objUser = User::find($id);
?>
<div class="row">
    <div class="col-md-2">
        <div class="btn-group btn-group-justified">            
            <a class="btn btn-primary col-sm-3" href="{{URL::to('system/user')}}"><i class="glyphicon glyphicon-list-alt"></i><br>List</a>     
        </div> 
    </div>
</div>
<hr>
<?php
$selectTypeUser = TypeUser::lists('name', 'id');
$selectEmployee = Employee::select(DB::raw('id'), DB::raw('concat (first_name," ",last_name) as name'))->where('active', '=', '1')->lists('name', 'id')
?>
{{ Form::open(array('url' => 'system/user/edit-save/'.$objUser->id,'class'=>'form-horizontal')) }}
<div class="row">
    <div class="col-sm-4">         
        {{Form::label('user', 'User Name')}} <span class="required-field">*</span>                
        {{ Form::text('user',$objUser->user,['class'=>'form-control','readonly'=>'readonly'])}}
        {{Form::label('password', 'Password')}}
        {{ Form::password('password',['class'=>'form-control'])}}
        {{Form::label('id_employee', 'Employee')}} <span class="required-field">*</span>                
        {{Form::select('id_employee',[''=>'']+$selectEmployee,$objUser->id_employee,['class'=>'form-control'] ) }}
        {{Form::label('id_type_user', 'Type User')}} <span class="required-field">*</span>                
        {{ Form::select('id_type_user', [''=>'']+$selectTypeUser, $objUser->id_type_user,['class'=>'form-control']) }}
    </div>
</div>
<div class="row">
    <hr>
    <div class="col-sm-4">         
        {{ Form::submit('Save',['class'=>'btn btn-default'])}}    
    </div>
</div>

{{ Form::close() }}
@if ($errors->any())
<br>
<div class="alert alert-danger">    
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Please fix the following errors:</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@stop

