@extends('sidebar')
@section('title')
ADD CAR TYPE
@stop
@section('content')
<ul class="nav nav-tabs nav-justified">
    <li class="disabled"><a href="#"  >Lead Information</a></li>    
    <li class="disabled"><a href="#"  >Address Information</a></li>    
    <li class="disabled"><a href="#"  >More Information</a></li>    
    <li class="disabled"><a href="#"  >Other</a></li>    
    <li class="active"><a href="#CT">Car Type</a></li>    
</ul> 
{{ Form::open(array('url' => 'car-type/save','class'=>'form-horizontal')) }}
<div class="tab-content">
    <div class="tab-pane active" id="CT">
        <input type="hidden" id="aux" value="0"> <!--auxiliar para poner valores a los campos desde modal car type--> 
        {{ Form::hidden('initRows','0',['id'=>'initRows'])}}
        {{ Form::hidden('rows','',['id'=>'rows'])}}
        {{ Form::hidden('id_leads',$id_leads)}}
        <a href="#" id="link-add-row-carType">Add Row</a>
        <div class="form-group">
            <hr>
            {{ Form::submit('Save',['class'=>'btn btn-default'])}}
        </div>
    </div>
</div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Car Type</h4>
            </div>
            <div id="modal-body" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop

