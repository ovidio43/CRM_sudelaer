@extends('sidebar')
@section('title')
List User
@stop
@section('content')
<div class="row">
    <div class="col-md-2">
        <div class="btn-group btn-group-justified">
            <a class="btn btn-primary col-sm-3" href="{{URL::to($mod.'/user/new')}}"><i class="glyphicon glyphicon-plus"></i><br>New</a>     
        </div> 
    </div>
</div>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>User</th>
            <th>Password</th>            
            <th>Employee</th>
            <th>Type User</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $objUser = User:: where('active', '=', '1')->where('id', '!=', '1')->get();
        foreach ($objUser as $rowU) {
            ?>        
            <tr>
                <td>{{$rowU->user}}</td>
                <td>**********</td>                
                <td>{{$rowU->employee->first_name.' '.$rowU->employee->last_name}}</td>                
                <td>{{$rowU->typeUser->name}}</td>                
                <td>
                    <?php if (Session::has('update')) { ?>
                        <a href="{{URL::to($mod.'/user/'.Session::get('update').'/'.$rowU->id)}}" title="UPDATE"><span class="glyphicon glyphicon-pencil"></span></a>
                    <?php } ?>
                </td>
                <td>
                    <?php if (Session::has('delete')) { ?>
                        <a href="{{URL::to($mod.'/user/'.Session::get('delete').'/'.$rowU->id)}}" class="delete-link" title="DELETE"><span class="glyphicon glyphicon-trash"></span></a>
                        <?php } ?>
                </td>    
            </tr>  
            <?php
        }
        ?>
    </tbody>
</table>

@stop



