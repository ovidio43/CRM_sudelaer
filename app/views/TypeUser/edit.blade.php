@extends('sidebar')
@section('title')
Edit TypeUser
@stop
@section('content')
<?php
$objTypeUser = TypeUser::find($id);
?>
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
<div class="row">
    <div class="col-md-2">
        <div class="btn-group btn-group-justified">
            <a class="btn btn-primary col-sm-3" href="{{URL::to($mod.'/type-user')}}"><i class="glyphicon glyphicon-list-alt"></i><br>List</a>     
        </div> 
    </div>
</div>
<hr>
{{ Form::open(array('url' => $mod.'/type-user/edit-save/'.$objTypeUser->id,'class'=>'form-horizontal')) }}
<div class="row">
    <div class="col-sm-4">         
        {{Form::label('name', 'Name')}} <span class="required-field">*</span>                
        {{ Form::text('name',$objTypeUser->name,['class'=>'form-control'])}}
        {{Form::label('description', 'Description')}} <span class="required-field">*</span>                
        {{ Form::textarea('description',$objTypeUser->description,['class'=>'form-control'])}}
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
                        $moduleTypeUser = $objTypeUser->module;
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
                            $checked = false;
                            foreach ($moduleTypeUser as $modTU) {
                                if ($modTU->id === $mod->id) {
                                    $checked = true;
                                }
                            }
                            ?>
                            <td>{{ Form::checkbox('id_module[]', $mod->id,$checked,['class'=>'form-control']) }}</td>
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
                        $actionTypeUser = $objTypeUser->action;
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
                            $checked = false;
                            foreach ($actionTypeUser as $actTU) {
                                if ($actTU->id === $act->id) {
                                    $checked = true;
                                }
                            }
                            ?>
                            <td>{{ Form::checkbox('id_action[]', $act->id,$checked,['class'=>'form-control']) }}</td>
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


