@extends('sidebar')
@section('title')
<b>MY CONTACTS</b>
<br>
@stop
@section('content')
<div class="panel-heading">
    <div class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar">
        <div class="btn-group pull-right" role="group" aria-label="...">
            <a href="/contacts/list" class="btn btn-default">Contacts List</a>            
        </div>        
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr> 
            <th>First Name</th> 
            <th>Last Name</th> 
            <th>Mobile Phone</th> 
            <th>Email Address</th> 
            <th>Address line 1</th>                          
            <th></th>                          
        </tr>
    </thead>
    <tbody>
        <?php
        $page = Input::get('page', 1);
        $items = 80;
        $fields = 'primary_buyer_first_name,primary_buyer_last_name,co_buyer_mobile_phone,primary_buyer_email_address,primary_buyer_address_line_1';
        $countRes = DB::select('SELECT count(*) as "count" FROM leads_import_data_from_csv where co_buyer_mobile_phone in (select mobile from leads)');
        $results = DB::select('SELECT ' . $fields . ' FROM leads_import_data_from_csv where co_buyer_mobile_phone in (select mobile from leads) LIMIT ' . (($page * $items) - $items) . ',' . $items);
        $pagination = Paginator::make($countRes, $countRes[0]->count, $items);
        /*         * *********** */
        foreach ($results as $row) {
            ?>
            <tr>                
                <td>{{$row->primary_buyer_first_name}}</td>
                <td>{{$row->primary_buyer_last_name}}</td>
                <td>{{$row->co_buyer_mobile_phone}}</td>
                <td>{{$row->primary_buyer_email_address}}</td>
                <td>{{$row->primary_buyer_address_line_1}}</td>                
                <td>                  
                    <a href="{{URL::to('leads/search/?s='.$row->co_buyer_mobile_phone.'&filter=mobile')}}" title="VIEW LEADS "><span class="glyphicon glyphicon-folder-open"></span></a>                    
                </td>         
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

{{ $pagination->links() }}
@stop


