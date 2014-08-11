@extends('sidebar')
@section('title')
MY LEADS
@stop
@section('content')

<b>Results Search : {{$s}}</b>
<ul class="nav nav-tabs">
    <li ><a href="{{URL::to($mod.'/my'.Session::get('list'))}}" class="force-redirect">Created by me</a></li> 
    <li><a href="{{URL::to($mod.'/myassignments'.Session::get('list'))}}" class="force-redirect">My Leads</a></li>        
    <?php if (Auth::user()->typeUser->name === 'Admin') { ?>  
        <li><a href="{{URL::to($mod.'/'.Session::get('list'))}}" class="force-redirect">All Leads</a></li>    
    <?php } else {
        ?>
        <li><a href="{{URL::to($mod.'/allactive'.Session::get('list'))}}" class="force-redirect">All Active</a></li> 
    <?php }
    ?>    
    <li class="active"><a href="#SEARCH"  role="tab" data-toggle="tab">RESULTS SEARCH</a></li>   
</ul> 
<div class="tab-content">
    <div class="tab-pane active" id="SEARCH">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Create by</th>
                    <th>Assigned to</th>
                    <th>Date Created</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (Auth::user()->typeUser->name === 'Admin') {
                    $objLeads = Leads::where('type', '=', 'leads')->where($filter, 'LIKE', '%' . $s . '%')->get()->take(100);
                } else {
                    $id_employee = Auth::user()->employee->id;
                    $objLeads = Leads::where('type', '=', 'leads')->where('create_by', '=', $id_employee)->orWhere('id_employee', '=', $id_employee)->where($filter, 'LIKE', '%' . $s . '%')->get()->take(100);
                }

                foreach ($objLeads as $rowL) {
                    $create_by = 'Web';
                    if ($rowL->create_by > 0) {
                        $objEmployee = Employee::find($rowL->create_by);
                        $create_by = $objEmployee->first_name . ' ' . $objEmployee->last_name . '(' . $objEmployee->user->user . ')';
                    }
                    $assign_to = 'undefined';
                    if ($rowL->allocation) {
                        $assign_to = $rowL->allocation->employee->first_name . ' ' . $rowL->allocation->employee->last_name; //. ' (' . $rowL->allocation->employee->user->user . ')';
                    }
                    ?>        
                    <tr class="{{$rowL->opportunity}}" title="{{$rowL->opportunity}}">
                        <td>{{$rowL->first_name.' '.$rowL->last_name}}</td>                
                        <td>{{$rowL->status.'-'.$rowL->create_by.'-'.$rowL->id_employee}}</td>                                                 
                        <td>{{$rowL->email_address}}</td>                
                        <td>{{$create_by}}</td>                
                        <td>{{ $assign_to }}</td>                
                        <td>{{ date("m-d-Y H:i:s", strtotime($rowL->date_entered)) }}</td>    
                        <td>
                            <?php if (Session::has('update')) { ?>
                                <a href="{{URL::to($mod.'/'.Session::get('update').'/'.$rowL->id.'#content-logs')}}" title="LOGS"><span class="glyphicon glyphicon-book"></span></a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if (Session::has('update')) { ?>
                                <a href="{{URL::to($mod.'/'.Session::get('update').'/'.$rowL->id)}}" title="DETAILS"><span class="glyphicon glyphicon-pencil"></span></a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if (Session::has('delete')) { ?>
                                <a href="{{URL::to($mod.'/'.Session::get('delete').'/'.$rowL->id)}}" title="DELETE" class="delete-link"><span class="glyphicon glyphicon-trash"></span></a>
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
    </div>
</div>
@stop



