@extends('sidebar')
@section('title')
EDIT CAR TYPE
@stop
@section('content')
<?php
$type = Leads::find($id_leads)->type;
if ($type !== 'leads') {
    $type = 'contacts';
}
?>

<ul class="nav nav-tabs nav-justified">
    <li ><a href="{{URL::to($type.'/edit/'.$id_leads)}}" class="force-redirect" >Lead Information</a></li>    
    <li ><a href="{{URL::to($type.'/edit/'.$id_leads)}}" class="force-redirect" >Address Information</a></li>    
    <li ><a href="{{URL::to($type.'/edit/'.$id_leads)}}" class="force-redirect" >More Information</a></li>    
    <li ><a href="{{URL::to($type.'/edit/'.$id_leads)}}" class="force-redirect" >Other</a></li>    
    <li class="active"><a href="#CT">Car Type</a></li>    
</ul> 
{{ Form::open(array('url' => 'leads/car-type/edit-save','class'=>'form-horizontal')) }}
<div class="tab-content">
    <div class="tab-pane active" id="CT">
        <input type="hidden" id="aux" value="0"> <!--auxiliar para poner valores a los campos desde modal car type--> 
        {{ Form::hidden('id_leads',$id_leads)}}
        <?php
        $objCartType = CarType::where('id_leads', '=', $id_leads)->get();
        $i = 0;
        $rows = '';
        foreach ($objCartType as $rowCT) {
            $rows.=$i . ',';
            ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-2">                        
                        {{Form::hidden('id_carType'.$i,$rowCT->id)}}
                        {{Form::label('make'.$i, 'Make')}}
                        {{ Form::text('make'.$i,$rowCT->make,['class'=>'form-control'])}}                        
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('year'.$i, 'Year')}}
                        {{ Form::text('year'.$i,$rowCT->year,['class'=>'form-control'])}}                        
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('stock'.$i, 'Stock')}}
                        {{ Form::text('stock'.$i,$rowCT->stock,['class'=>'form-control'])}}                        
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('model'.$i, 'Model')}}
                        {{ Form::text('model'.$i,$rowCT->model,['class'=>'form-control'])}}                        
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('budget'.$i, 'Budget')}}
                        {{ Form::text('budget'.$i,$rowCT->budget,['class'=>'form-control'])}}                        
                    </div>
                    <div class="col-sm-2">
                        <br>
                        <a role="button" title="ADD" class="btn btn-primary link-get-car-type" href="#" rel="{{$i}}">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a> 
                        <a role="button" title="Remove" href="{{URL::to('car-type/delete/'.$rowCT->id)}}" class="link-delete-row-carType btn btn-primary btn-danger" rel="{{$i}}">
                            <span class=" glyphicon glyphicon-minus"></span>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
        {{ Form::hidden('initRows',$i,['id'=>'initRows'])}}
        {{ Form::hidden('rows',$rows,['id'=>'rows'])}}

        <a href="#" id="link-add-row-carType">Add Row</a>
        <div class="form-group">
            <hr>
            {{ Form::submit('Save',['class'=>'btn btn-primary'])}}
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
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop

