@extends('sidebar')
@section('title')
MY LEADS
@stop
@section('content')
<ul class="nav nav-tabs">
    <li class="active"><a href="#MY"  role="tab" data-toggle="tab">Created by me</a></li>        
    <li><a href="{{URL::to($mod.'/myassignments'.Session::get('list'))}}" class="force-redirect">My leads</a></li>        
    <?php if (Auth::user()->typeUser->name === 'Admin') { ?>  
        <li><a href="{{URL::to($mod.'/'.Session::get('list'))}}" class="force-redirect">All Leads</a></li>    
    <?php } ?>  
</ul> 
<div class="tab-content">
    <div class="tab-pane active" id="MY">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Email</th>                                        
                    <th>Date Created</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id_employee = Auth::user()->employee->id;
                $objLeads = Leads::where('type', '=', 'leads')->where('create_by', '=', $id_employee)->orderBy('date_entered', 'DESC')->paginate(20);
                foreach ($objLeads as $rowL) {
                    ?>        
                <tr class="{{$rowL->opportunity}}" title="{{$rowL->opportunity}}">
                        <td>{{$rowL->first_name.' '.$rowL->last_name}}</td>                
                        <td>{{$rowL->status}}</td>                
                        <td>{{$rowL->email_address}}</td>                                                                             
                        <td>{{$rowL->date_entered}}</td>    
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
        {{ $objLeads->links(); }}
    </div>
</div>

@stop



