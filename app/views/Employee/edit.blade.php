@extends('sidebar')
@section('title')
Edit Employee
@stop
@section('content')
<?php
$objEmployee = Employee::find($id);
?>
<div class="row">
    <div class="col-md-2">
        <div class="btn-group btn-group-justified">
            <a class="btn btn-primary col-sm-3" href="{{URL::to('system/employee')}}"><i class="glyphicon glyphicon-list-alt"></i><br>List</a>     
        </div> 
    </div>
</div>
<hr>
{{ Form::open(array('url' => 'system/employee/edit-save/'.$objEmployee->id,'class'=>'form-horizontal')) }}
<div class="row">
    <div class="col-sm-4"> 
        {{Form::label('first_name', 'First Name')}} <span class="required-field">*</span>                
        {{ Form::text('first_name',$objEmployee->first_name,['class'=>'form-control'])}}
        {{Form::label('last_name', 'Last Name')}} <span class="required-field">*</span>                
        {{ Form::text('last_name',$objEmployee->last_name,['class'=>'form-control'])}}
        {{Form::label('phone', 'phone')}} <span class="required-field">*</span>                
        {{ Form::text('phone',$objEmployee->phone,['class'=>'form-control'])}}

    </div>
    <div class="col-sm-4"> 
        {{Form::label('cellphone', 'Cell Phone')}} <span class="required-field">*</span>                
        {{ Form::text('cellphone',$objEmployee->cellphone,['class'=>'form-control'])}}
        {{Form::label('address', 'address')}} <span class="required-field">*</span>                
        {{ Form::text('address',$objEmployee->address,['class'=>'form-control'])}}
        {{Form::label('email', 'Email')}} <span class="required-field">*</span>                
        {{ Form::text('email',$objEmployee->email,['class'=>'form-control'])}}

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


