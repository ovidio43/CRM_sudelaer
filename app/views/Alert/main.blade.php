@extends('sidebar')
@section('title')
ALERTS
@stop
@section('content')

{{ Form::open(array('url' => $mod.'/alert/save','class'=>'form-horizontal')) }}
<table class="table table-striped">
    <thead>
        <tr>
            <th></th>
            <?php
            $objTypeUser = TypeUser::all();
            foreach ($objTypeUser as $rowTU) {
                ?>
                <th>{{$rowTU->name}}</th>          
                <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $selectTemplates = Templates::lists('name', 'id');
        $objAlert = Alert::all();
        foreach ($objAlert as $rowA) {
            ?>
            <tr>
                <td>
                    <b>{{$rowA->title}}</b>
                    <?php if (Session::has('update')) { ?>
                        <a href="{{URL::to($mod . '/alert/' . Session::get('update').'/'.$rowA->id)}}" title="SET TEMPLATE"><span class=" glyphicon glyphicon-text-width"></span></a>
                    <?php } ?>
                </td>
                <?php
                foreach ($objTypeUser as $rowTU) {
                    $checked = false;
                    if ($rowTU->alert->find($rowA->id)) {
                        $checked = true;
                    }
                    ?>
                    <td>{{Form::checkbox('id_alert_type_user[]',$rowA->id.'|'.$rowTU->id , $checked,['class'=>'form-control']);}}</td>   
                    <?php
                }
                ?>
            </tr>     
            <?php
        }
        ?>
    </tbody>
</table>
{{ Form::submit('Save',['class'=>'btn btn-default pull-right'])}} 
{{ Form::close() }}
<br><br>
<hr>
<div class="panel panel-default" id="content-template">
    <div class="panel-heading"><b>Templates</b>
        <?php
        if (Session::has('insert')) {
            ?>
            <a href="{{URL::to($mod . '/alert/templates/' . Session::get('insert'))}}" class=" pull-right" title="Add New Temlate" role="button">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
            <?php
        }
        ?>

    </div>
    <ul class="list-group">
        <?php
        $objTemplates = Templates::all();
        foreach ($objTemplates as $t) {
            ?>
            <li class="list-group-item">
                {{$t->name}}
                <?php if (Session::has('update')) { ?>
                    <a href="{{URL::to($mod . '/alert/templates/' . Session::get('update').'/'.$t->id)}}" title="EDIT"><span class="glyphicon glyphicon-pencil "></span></a>
                    <?php } ?>
            </li>
            <?php
        }
        ?>
    </ul>
</div>

@stop





