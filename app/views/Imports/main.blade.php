@extends('sidebar')
@section('title')
<b>IMPORTS</b>
<hr>
@stop
@section('content')
<div>
    <div class="alert alert-warning" role="alert"><strong>Warning!</strong></div>
    {{ Form::open(array('url' => $mod.'/imports/upload','files' => true,'class'=>'form-horizontal')) }}
    <div class="form-group">            
        <div class="col-sm-4">
            {{Form::label('file', 'Upload File_x.csv')}}
            {{Form::file('file')}}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            {{Form::submit('Import File',['class'=>'btn btn-primary '])}}
        </div>
    </div>  
    {{ Form::close() }}    
</div>
@stop





