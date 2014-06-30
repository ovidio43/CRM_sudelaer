@extends('sidebar')
@section('title')
List Type User
@stop
@section('content')
<div class="row">
    <div class="col-md-2">
        <div class="btn-group btn-group-justified">
            <a class="btn btn-primary col-sm-3" href="{{URL::to('system/type-user/new')}}"><i class="glyphicon glyphicon-plus"></i><br>New</a>     
        </div> 
    </div>
</div>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>            
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $objTypeUser = TypeUser:: all();
        foreach ($objTypeUser as $rowTU) {
            ?>        
            <tr>
                <td>{{$rowTU->name}}</td>
                <td>{{$rowTU->description}}</td>                
                <td><a href="{{URL::to('system/type-user/edit/'.$rowTU->id)}}" title="UPDATE"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><a href="{{URL::to('system/type-user/delete/'.$rowTU->id)}}" class="delete-link" title="DELETE"><span class="glyphicon glyphicon-trash"></span></a></td>    
            </tr>  
            <?php
        }
        ?>
    </tbody>
</table>

@stop



