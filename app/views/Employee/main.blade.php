@extends('sidebar')
@section('title')
List Employee
@stop
@section('content')
<div class="row">
    <div class="col-md-2">
        <div class="btn-group btn-group-justified">
            <a class="btn btn-primary col-sm-3" href="{{URL::to('system/employee/new')}}"><i class="glyphicon glyphicon-plus"></i><br>New</a>     
        </div> 
    </div>
</div>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Cel Phone</th>
            <th>Address</th>
            <th>Email</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $objemployee = Employee:: where('active', '=', '1')->where('id', '!=', '1')->get();
        foreach ($objemployee as $rowE) {
            ?>        
            <tr>
                <td>{{$rowE->first_name}}</td>
                <td>{{$rowE->last_name}}</td>
                <td>{{$rowE->phone}}</td>
                <td>{{$rowE->cellphone}}</td>
                <td>{{$rowE->address}}</td>                
                <td>{{$rowE->email}}</td>
                <td><a href="{{URL::to('system/employee/edit/'.$rowE->id)}}" title="UPDATE"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><a href="{{URL::to('system/employee/delete/'.$rowE->id)}}" title="DELETE" class="delete-link"><span class="glyphicon glyphicon-trash"></span></a></td>    
            </tr>  
            <?php
        }
        ?>
    </tbody>
</table>

@stop

