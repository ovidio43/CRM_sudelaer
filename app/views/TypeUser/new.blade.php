@extends('sidebar')
@section('title')
New Type User
@stop
@section('content')
@if ($errors->any())
<div class="alert alert-danger">    
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <b>Please fix the following errors:</b>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-md-2">
        <div class="btn-group btn-group-justified">
            <a class="btn btn-primary col-sm-3" href="{{URL::to($mod.'/type-user')}}"><i class="glyphicon glyphicon-list-alt"></i><br>List</a>     
        </div> 
    </div>
</div>
<hr>
{{ Form::open(array('url' => $mod.'/type-user/save','class'=>'form-horizontal')) }}
<div class="row">
    <div class="col-sm-4"> 
        {{Form::label('name', 'Name')}} <span class="required-field">*</span>                
        {{ Form::text('name','',['class'=>'form-control'])}}
        {{Form::label('description', 'Description')}} <span class="required-field">*</span>                
        {{ Form::textarea('description','',['class'=>'form-control'])}}
    </div>    
</div>
<div class="row">
    <br>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#module">Module</a></li>
        <li><a data-toggle="tab" href="#action">Action</a></li>
    </ul>
    <div class="tab-content">
        <div id="module" class="tab-pane active">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?php
                        $module = Module::all();
                        foreach ($module as $mod) {
                            ?>
                            <th>{{strtoupper($mod->name)}}</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        foreach ($module as $mod) {
                            ?>
                            <td>{{ Form::checkbox('id_module[]', $mod->id,false,['class'=>'form-control']) }}</td>
                        <?php } ?>             
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="action" class="tab-pane">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?php
                        $action = Action::all();
                        foreach ($action as $act) {
                            ?>
                            <th>{{ucwords($act->name)}}</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        foreach ($action as $act) {
                            ?>
                            <td>{{ Form::checkbox('id_action[]', $act->id,false,['class'=>'form-control']) }}</td>
                        <?php } ?>             
                    </tr>
                </tbody>
            </table>
        </div>     
    </div>
</div>
<div class="row">
    <hr>
    <div class="col-sm-4">         
        {{ Form::submit('Save',['class'=>'btn btn-default'])}}    
    </div>
</div>

{{ Form::close() }}

@stop

