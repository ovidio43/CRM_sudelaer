@extends('sidebar')
@section('title')
EDIT ALERT
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
<?php
$selectTemplate = Templates::lists('name', 'id');
$alert = Alert::find($id);
?>
{{ Form::open(array('url' => $mod.'/alert/save-edit/'.$alert->id,'class'=>'form-horizontal')) }}
<div class="form-group">            
    <div class="col-sm-4">
        {{Form::label('title', 'Title')}} <span class="required-field">*</span>                
        {{ Form::text('title',$alert->title,['class'=>'form-control'])}}
        {{Form::label('id_template', 'Template')}} <span class="required-field">*</span>  
        {{ Form::select('id_template', [''=>'']+$selectTemplate, $alert->id_template,['class'=>'form-control']) }}
    </div> 
    <div class="col-sm-4">
        {{Form::label('is_checked', 'Send clients')}} 
        <?php
        $checked = ($alert->id_template_ext > 0) ? true : false;
        $hidden = ($alert->id_template_ext > 0) ? '' : 'hidden';
        ?>

        {{Form::checkbox('is_checked', 'yes', $checked)}}          
        {{ Form::select('id_template_ext', ['0'=>'']+$selectTemplate, $alert->id_template_ext,['id'=>'id_template_ext','class'=>'form-control '.$hidden]) }}
    </div>
</div> 

<div class="btn-group pull-right">
    <a role="button" class="btn btn-primary " href="{{URL::to($mod.'/alert#content-template')}}">Cancel</a>
    {{ Form::submit('Save',['class'=>'btn btn-default '])}} 
</div>
{{ Form::close() }}
@stop





