@extends('sidebar')
@section('title')
MY LEADS
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
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $objLeads = Leads::where('type', '=', 'leads')->orderBy('date_entered', 'DESC')->paginate(10);
        foreach ($objLeads as $rowL) {
            $user = 'Web';
            if ($rowL->id_employee > 0) {
                $objEmployee = Employee::find($rowL->id_employee);
               //$user = $objEmployee->first_name . ' ' . $objEmployee->last_name . '(' . $objEmployee->user->user . ')';
                $user = $objEmployee->first_name . ' ' . $objEmployee->last_name ;
                
            }
            ?>        
            <tr>
                <td>{{$rowL->first_name.' '.$rowL->last_name}}</td>                
                <td>{{$rowL->status}}</td>                
                <td>{{$rowL->account_name}}</td>                
                <td>{{$rowL->office_phone}}</td>                
                <td>{{$rowL->email_address}}</td>                
                <td>{{$user}}</td>                
                <td>{{$rowL->date_entered}}</td>                
                <td>
                    <?php if (Session::has('update')) { ?>
                        <a href="{{URL::to('leads/'.Session::get('update').'/'.$rowL->id)}}" title="DETAILS"><span class="glyphicon glyphicon-list-alt"></span></a>
                    <?php } ?>
                </td>
                <td>
                    <?php if (Session::has('update')) { ?>
                        <a href="{{URL::to('leads/'.Session::get('update').'/'.$rowL->id)}}" title="DETAILS"><span class="glyphicon glyphicon-pencil"></span></a>
                    <?php } ?>
                </td>
                <td>
                    <?php if (Session::has('delete')) { ?>
                        <a href="{{URL::to('leads/'.Session::get('delete').'/'.$rowL->id)}}" title="DELETE" class="delete-link"><span class="glyphicon glyphicon-trash"></span></a>
                    <?php } ?>
                </td>                 
                <td>
                    <?php if (Session::has('migrate')) { ?>
                        <a href="{{URL::to('migrate-to-contacts/'.$rowL->id)}}" title="MIGRATE TO CONTACTS" class="migrate-link"><span class=" glyphicon glyphicon-random"></span></a>
                        <?php } ?>
                </td>                
            </tr>        
            <?php
        }
        ?>
    </tbody>
</table>
{{ $objLeads->links(); }}
@stop



