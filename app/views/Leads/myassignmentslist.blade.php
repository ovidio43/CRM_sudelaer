@extends('sidebar')
@section('title')
MY LEADS
@stop
@section('content')

<ul class="nav nav-tabs">
    <li ><a href="{{URL::to($mod.'/my'.Session::get('list'))}}" class="force-redirect">Created by me</a></li> 
    <li class="active"><a href="#MA" >My Leads</a></li>        
    <?php if (Auth::user()->typeUser->name === 'Admin') { ?>    
        <li><a href="{{URL::to($mod.'/'.Session::get('list'))}}" class="force-redirect">All Leads</a></li>  
    <?php } else {
        ?>
        <li><a href="{{URL::to($mod.'/allactive'.Session::get('list'))}}" class="force-redirect">All Active</a></li> 
    <?php }
    ?> 
</ul> 
<div class="tab-content">
    <div class="tab-pane active" id="MY">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>                    
                    <th>Email</th> 
                    <th>Note</th>
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
                $objLeads = Leads::where('type', '=', 'leads')->where('id_employee', '=', $id_employee)->orderBy('date_entered', 'DESC')->paginate(20);
                foreach ($objLeads as $rowL) {
                    ?>        
                    <tr class="{{$rowL->opportunity}}" title="{{$rowL->opportunity}}">
                        <td>{{$rowL->first_name.' '.$rowL->last_name}}</td>                
                        <td>{{$rowL->status}}</td>                
                        <td>{{$rowL->email_address}}</td>   
                         <td>
                            <button type="button" class="btn btn-default popover-dismiss" data-container="body" data-toggle="popover" data-placement="bottom" 
                                    data-content="{{$rowL->note}}">
                                Note
                            </button>
                        </td> 
                        <td>{{ date("m-d-Y H:i:s", strtotime($rowL->date_entered)) }}</td>    
                        <td>
                            <?php if (Session::has('update')) { ?>
                                <a href="{{URL::to($mod.'/'.Session::get('update').'/'.$rowL->id.'#content-logs')}}" title="LOGS"><span class="glyphicon glyphicon-book"></span></a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if (Session::has('update')) { ?>
                                <a href="{{URL::to($mod.'/'.Session::get('update').'/'.$rowL->id)}}" title="EDIT"><span class="glyphicon glyphicon-pencil"></span></a>
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



