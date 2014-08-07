@extends('sidebar')
@section('title')
New Employee
@stop
@section('content')
<div class="row">
    <div class="col-md-2">
        <div class="btn-group btn-group-justified">
            <a class="btn btn-primary col-sm-3" href="{{URL::to($mod.'/employee')}}"><i class="glyphicon glyphicon-list-alt"></i><br>List</a>     
        </div> 
    </div>
</div>
<hr>
{{ Form::open(array('url' => $mod.'/employee/save','class'=>'form-horizontal')) }}
<div class="row">
    <div class="col-sm-4"> 
        {{Form::label('first_name', 'First Name')}} <span class="required-field">*</span>                
        {{ Form::text('first_name','',['class'=>'form-control'])}}
        {{Form::label('last_name', 'Last Name')}} <span class="required-field">*</span>                
        {{ Form::text('last_name','',['class'=>'form-control'])}}
        {{Form::label('phone', 'phone')}} 
        {{ Form::text('phone','',['class'=>'form-control'])}}

    </div>
    <div class="col-sm-4"> 
        {{Form::label('cellphone', 'Cell Phone')}} 
        {{ Form::text('cellphone','',['class'=>'form-control'])}}
        {{Form::label('address', 'address')}}
        {{ Form::text('address','',['class'=>'form-control'])}}
        {{Form::label('email', 'Email')}} <span class="required-field">*</span>                
        {{ Form::text('email','',['class'=>'form-control'])}}

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

