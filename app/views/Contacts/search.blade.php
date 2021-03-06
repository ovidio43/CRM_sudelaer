<?php
if (Request::isMethod('post')) {
    $input = Input::all();
    Session::put('filter', $input['filter']);
    Session::put('wildcard', $input['wildcard']);
}
?>
@extends('sidebar')
@section('title')
<b>RESULTS TO : {{Session::get('wildcard')}} </b>
<hr>
@stop
@section('content')
<div class="panel-heading">
    <div class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar">
        <div class="btn-group pull-right" role="group" aria-label="...">
            <a href="{{URL::to('contacts/ambiguous-list')}}" class="btn btn-warning">
                <span class="glyphicon glyphicon-exclamation-sign"></span> List of ambiguous records
            </a>            
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
        if (Request::isMethod('post')) {
            $input = Input::all();
            Session::put('filter', $input['filter']);
            Session::put('wildcard', $input['wildcard']);
        }
        $page = Input::get('page', 1);
        $items = 50;
        $fields = 'id,primary_buyer_first_name,primary_buyer_last_name,co_buyer_mobile_phone,primary_buyer_email_address,primary_buyer_address_line_1';
        $countRes = DB::select('SELECT count(*) as "count" FROM leads_import_data_from_csv where co_buyer_mobile_phone not in (select mobile from leads where type="leads")and ' . Session::get('filter') . ' like "%' . Session::get('wildcard') . '%"');
        $results = DB::select('SELECT ' . $fields . ' FROM leads_import_data_from_csv where co_buyer_mobile_phone not in (select mobile from leads where type="leads") and ' . Session::get('filter') . ' like "%' . Session::get('wildcard') . '%" LIMIT ' . (($page * $items) - $items) . ',' . $items);
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
                    <a href="{{URL::to($mod.'/contact-detail/'.$row->id)}}" title="VIEW DETAIL "><span class="glyphicon glyphicon-list-alt"></span></a>                    
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

{{ $pagination->links() }}
@stop


