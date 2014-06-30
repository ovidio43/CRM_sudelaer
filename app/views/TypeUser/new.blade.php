@extends('sidebar')
@section('title')
New Type User
@stop
@section('content')
<div class="row">
    <div class="col-md-2">
        <div class="btn-group btn-group-justified">
            <a class="btn btn-primary col-sm-3" href="{{URL::to('system/type-user')}}"><i class="glyphicon glyphicon-list-alt"></i><br>List</a>     
        </div> 
    </div>
</div>
<hr>
{{ Form::open(array('url' => 'system/type-user/save','class'=>'form-horizontal')) }}
<div class="row">
    <div class="col-sm-4"> 
        {{Form::label('name', 'Name')}} <span class="required-field">*</span>                
        {{ Form::text('name','',['class'=>'form-control'])}}
        {{Form::label('description', 'Description')}} <span class="required-field">*</span>                
        {{ Form::textarea('description','',['class'=>'form-control'])}}
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

