@extends('sidebar')
@section('title')
MY CONTACTS
@stop
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Account Name</th>
            <th>Office Phone</th>
            <th>Email</th>
            <th>User</th>
            <th>Date Created</th>
            <th></th>
            <th></th>            
        </tr>
    </thead>
    <tbody>
        <?php
        $objLeads = Leads::where('type', '=', 'contacts')->get();
        foreach ($objLeads as $rowL) {
            ?>        
            <tr>
                <td>{{$rowL->first_name}}</td>                
                <td>{{$rowL->status}}</td>                
                <td>{{$rowL->account_name}}</td>                
                <td>{{$rowL->office_phone}}</td>                
                <td>{{$rowL->email_address}}</td>                
                <td>Empty</td>               
                <td>{{$rowL->date_entered}}</td>                
                <td><a href="{{URL::to('contacts/edit/'.$rowL->id)}}" title="UPDATE"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><a href="#" title="DELETE"><span class="glyphicon glyphicon-trash"></span></a></td>                
            </tr>        
            <?php
        }
        ?>
    </tbody>
</table>

@stop


