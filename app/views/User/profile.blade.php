@extends('sidebar')
@section('title')
Edit My Profile
@stop
@section('content')
{{ Form::open(array('url' => 'edit-profile/'.Auth::user()->employee->id,'class'=>'form-horizontal')) }}
<div class="row">
    <div class="col-sm-4"> 
        {{Form::label('user', 'User Name')}} <span class="required-field">*</span>                
        {{ Form::text(null,Auth::user()->user,['class'=>'form-control','readonly'=>'readonly'])}}
        {{Form::label('password', 'Password')}}
        {{ Form::password('password',['class'=>'form-control'])}}
        {{Form::label('first_name', 'First Name')}} <span class="required-field">*</span>                
        {{ Form::text('first_name',Auth::user()->employee->first_name,['class'=>'form-control'])}}
        {{Form::label('last_name', 'Last Name')}} <span class="required-field">*</span>                
        {{ Form::text('last_name',Auth::user()->employee->last_name,['class'=>'form-control'])}}

    </div>
    <div class="col-sm-4"> 
        {{Form::label('phone', 'phone')}} 
        {{ Form::text('phone',Auth::user()->employee->phone,['class'=>'form-control'])}}
        {{Form::label('cellphone', 'Cell Phone')}}
        {{ Form::text('cellphone',Auth::user()->employee->cellphone,['class'=>'form-control'])}}
        {{Form::label('address', 'address')}}
        {{ Form::text('address',Auth::user()->employee->address,['class'=>'form-control'])}}
        {{Form::label('email', 'Email')}} <span class="required-field">*</span>                
        {{ Form::text('email',Auth::user()->employee->email,['class'=>'form-control'])}}
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


