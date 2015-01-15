@extends('sidebar')
@section('title')
TEMPLATES
@stop
@section('content')
@if ($errors->any())
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
{{ Form::open(array('url' => $mod.'/alert/templates/save','class'=>'form-horizontal')) }}
<div class="form-group">            
    <div class="col-sm-4">
        {{Form::label('name', 'Name')}} <span class="required-field">*</span>                
        {{ Form::text('name','',['class'=>'form-control'])}}


    </div> 
</div> 
<div class="form-group">            
    <div class="col-sm-12">
        {{ Form::textarea('content','',['class'=>'form-control','id'=>'content'])}}
    </div> 
</div> 
<div class="btn-group pull-right">
    <a role="button" class="btn btn-primary " href="{{URL::to($mod.'/alert#content-template')}}">Cancel</a>
    {{ Form::submit('Save',['class'=>'btn btn-default '])}} 
</div>

{{ Form::close() }}
@stop





