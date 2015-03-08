@extends('sidebar')
@section('title')
EDIT LEADS
@stop
@section('content')
<?php
$objLeads = Leads::find($id);
if (!$objLeads->logs) {
    ?>
    <div role="alert" class="alert alert-info">Creating Logs..</div>
    <?php
    $objLogs = new Logs(); //forzando a crear logs para leads
    $objLogs->id_leads = $id;
    $objLogs->save();
    echo '<script type="text/javascript"> document.location.reload();</script>';
    exit();
}
if ($objLeads->read_by_employee != $objLeads->id_employee) {
    $objLeads->read_by_employee = $objLeads->id_employee;
    $objLeads->save();
}
?>
@if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Please fix the following errors:</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<ul class="nav nav-tabs">
    <li class="active"><a href="#LA"  role="tab" data-toggle="tab">Lead Information</a></li>    
    <li><a href="#AI"  role="tab" data-toggle="tab">Address Information</a></li>    
    <li><a href="#MI"  role="tab" data-toggle="tab">More Information</a></li>    
    <li><a href="#O"  role="tab" data-toggle="tab">Other</a></li>    
    <li><a href="{{URL::to($mod.'/car-type/edit/'.$objLeads->id)}}" class="force-redirect">Car Type</a></li>   
</ul> 
{{ Form::open(array('url' => 'leads/edit-save/'.$objLeads->id,'class'=>'form-horizontal')) }}
<br>
{{ Form::submit('Save',['class'=>'btn btn-primary '])}}    
<div class="tab-content">
    <div class="tab-pane active" id="LA">
        <div class="form-group">            
            <div class="col-sm-4"> 
                <?php
                $salutation = [ 'Mr.' => 'Mr.', 'Ms.' => 'Ms.', 'Mrs.' => 'Mrs.', 'Dr.' => 'Dr.', 'Prof.' => 'Prof.'];
                $leadSource = [ '' => '', 'Univision Washington' => 'Univision Washington', 'DContigo Tv Show' => 'DContigo Tv Show', 'Telemundo Washington' => 'Telemundo Washington',
                    'Radio Lanueva87.7' => 'Radio Lanueva87.7', 'Variedades de Washington' => 'Variedades de Washington', 'Referido' => 'Referido', 'Cliente actual' => 'Cliente actual',
                    'Periodicos' => 'Periodicos', 'Revistas' => 'Revistas', 'Cliente Antiguo' => 'Cliente Antiguo', 'Otros' => 'Otros'];
                $leadType = [ '' => '', 'Phone in' => 'Phone in', 'Walk in' => 'Walk in', 'Web' => 'Web'];
                $selectState = [ '' => '', 'AL' => "Alabama", 'AK' => "Alaska", 'AZ' => "Arizona", 'AR' => "Arkansas", 'CA' => "California", 'CO' => "Colorado", 'CT' => "Connecticut",
                    'DE' => "Delaware", 'DC' => "District Of Columbia", 'FL' => "Florida", 'GA' => "Georgia", 'HI' => "Hawaii", 'ID' => "Idaho", 'IL' => "Illinois", 'IN' => "Indiana", 'IA' => "Iowa",
                    'KS' => "Kansas", 'KY' => "Kentucky", 'LA' => "Louisiana", 'ME' => "Maine", 'MD' => "Maryland", 'MA' => "Massachusetts", 'MI' => "Michigan", 'MN' => "Minnesota", 'MS' => "Mississippi", 'MO' => "Missouri", 'MT' => "Montana",
                    'NE' => "Nebraska", 'NV' => "Nevada", 'NH' => "New Hampshire", 'NJ' => "New Jersey", 'NM' => "New Mexico", 'NY' => "New York", 'NC' => "North Carolina", 'ND' => "North Dakota",
                    'OH' => "Ohio", 'OK' => "Oklahoma", 'OR' => "Oregon", 'PA' => "Pennsylvania", 'RI' => "Rhode Island", 'SC' => "South Carolina", 'SD' => "South Dakota", 'TN' => "Tennessee", 'TX' => "Texas", 'UT' => "Utah",
                    'VT' => "Vermont", 'VA' => "Virginia", 'WA' => "Washington", 'WV' => "West Virginia", 'WI' => "Wisconsin", 'WY' => "Wyoming"];
                $selectProof_of_work = ['' => '', 'Boleta de pago' => 'Boleta de pago', 'carta de empleador' => 'carta de empleador', 'taxes' => 'taxes', 'trabaja por su cuenta' => 'trabaja por su cuenta', 'ninguno' => 'ninguno'];
                $selectI_have = ['' => '', 'Seguro Social' => 'Seguro Social', 'Tax Id' => 'Tax Id'];
                $selectMy_credit_is = ['' => '', 'Exelente' => 'Exelente', 'Bueno' => 'Bueno', 'regular' => 'regular', 'Malo' => 'Malo', 'No tengo' => 'No tengo'];
                ?>
                {{Form::label('mobile', 'Mobile')}} <span class="required-field">*</span> 
                <a href="#" onclick="capturarValorPhone()"  id="myPhoneLink" class="thickbox">
                    <img title="Verify phone number" src="{{ URL::asset('img/phone.png')}}" width="25px" heigth="25px">
                </a>
                {{ Form::text('mobile',$objLeads->mobile,['class'=>'form-control','id'=>'mobile','rel'=>$objLeads->id])}}

                {{Form::label('salutation', 'Salutation')}}
                {{ Form::select('salutation',$salutation, $objLeads->salutation,['class'=>'form-control']) }}                
                {{Form::label('first_name', 'First Name')}} <span class="required-field">*</span>                
                {{ Form::text('first_name',$objLeads->first_name,['class'=>'form-control'])}}
                {{Form::label('last_name', 'Last Name')}} <span class="required-field">*</span>
                {{ Form::text('last_name',$objLeads->last_name,['class'=>'form-control'])}}                

                {{Form::label('date_of_birth', 'Date of birth')}} 
                {{ Form::text('date_of_birth',$objLeads->date_of_birth,['class'=>'form-control default-dtp'])}}  
                {{Form::label('i_have', 'I have')}} 
                {{ Form::select('i_have',$selectI_have, $objLeads->i_have,['class'=>'form-control']) }}    
                {{Form::label('social_security_number', 'Social security number')}} 
                {{ Form::text('social_security_number',$objLeads->social_security_number,['class'=>'form-control'])}}  

            </div>  
            <div class="col-sm-4"> 
                {{Form::label('email_address', 'Email Address')}} <span class="required-field">*</span>
                <a href="#" onclick="capturarValorEmail()"  id="myEmailLink" class="thickbox">
                    <img title="Verify email address" src="{{ URL::asset('img/email.png')}}" width="25px" heigth="25px">
                </a>
                {{ Form::text('email_address',$objLeads->email_address,['class'=>'form-control'])}}
                {{Form::label('lead_type', 'Lead Type')}}<span class="required-field">*</span>
                {{ Form::select('lead_type', $leadType, $objLeads->lead_type,['class'=>'form-control']) }} 
                {{Form::label('lead_source', 'Lead source')}}
                {{ Form::select('lead_source', $leadSource, $objLeads->lead_source,['class'=>'form-control']) }} 
                {{Form::label('home_phone', 'Home Phone')}}
                {{ Form::text('home_phone',$objLeads->home_phone,['class'=>'form-control'])}}
                                
                {{Form::label('license_emitted_at', 'License emitted at')}} 
                {{ Form::select('license_emitted_at', $selectState, $objLeads->license_emitted_at,['class'=>'form-control']) }} 
                {{Form::label('proof_of_work', 'Proof of work')}}
                {{ Form::select('proof_of_work',$selectProof_of_work, $objLeads->proof_of_work,['class'=>'form-control']) }}                
                {{Form::label('my_credit_is', 'My credit is')}} 
                {{ Form::select('my_credit_is', $selectMy_credit_is, $objLeads->my_credit_is,['class'=>'form-control']) }} 

            </div>   

            <div class="col-sm-4">
                {{Form::label('note', 'Note')}}
                {{ Form::textarea('note',$objLeads->note,['class'=>'form-control'])}}                 
            </div>
        </div>
    </div>    
    <div class="tab-pane " id="AI">
        <div class="form-group">
            <div class="col-sm-6">
                {{Form::label('primary_address_street', 'Primary Address Street')}}
                {{ Form::textarea('primary_address_street',$objLeads->primary_address_street,['class'=>'form-control'])}}
                {{Form::label('primary_address_city', 'Primary Address City')}}
                {{ Form::text('primary_address_city',$objLeads->primary_address_city,['class'=>'form-control'])}}
                {{Form::label('primary_address_state', 'Primary Address State')}}
                {{ Form::select('primary_address_state',$selectState, $objLeads->primary_address_state,['class'=>'form-control']) }}                  
                {{Form::label('primary_address_zipcode', 'Primary Address Zip Code')}}
                {{ Form::text('primary_address_zipcode',$objLeads->primary_address_zipcode,['class'=>'form-control'])}}                
            </div>
            <div class="col-sm-6">
                {{Form::label('alt_address_street', 'Alt Address Street')}}
                {{ Form::textarea('alt_address_street',$objLeads->alt_address_street,['class'=>'form-control'])}}
                {{Form::label('alt_address_city', 'Alt Address City')}}
                {{ Form::text('alt_address_city',$objLeads->alt_address_city,['class'=>'form-control'])}}
                {{Form::label('alt_address_state', 'Alt  Address State')}}
                {{ Form::select('alt_address_state',$selectState, $objLeads->alt_address_state,['class'=>'form-control']) }}                  
                {{Form::label('alt_address_zipcode', 'Alt Address Postalcode')}}
                {{ Form::text('alt_address_zipcode',$objLeads->alt_address_zipcode,['class'=>'form-control'])}}                
                {{Form::label('copy', 'Copy address from left')}}
                {{ Form::checkbox('copy') }}
            </div>
        </div>
        <hr>

    </div>    
    <div class="tab-pane " id="MI">
        <div class="form-group">
            <div class="col-sm-6">                 
                <?php $status = ['New' => 'New', 'Assigned' => 'Assigned', 'In Process' => 'In Process', 'Converted' => 'Converted', 'Recycled' => 'Recycled', 'Dead' => 'Dead']; ?>
                {{Form::label('status', 'Status')}}
                {{ Form::select('status', $status, $objLeads->status,['class'=>'form-control']) }}                 
                {{Form::label('status_description', 'Status Description')}}
                {{ Form::textarea('status_description',$objLeads->status_description,['class'=>'form-control'])}}   
                {{Form::label('opportunity_amount', 'Opportunity Amount')}}
                {{ Form::text('opportunity_amount',$objLeads->opportunity_amount,['class'=>'form-control'])}}  
                {{Form::label('id_campaign', 'Campaign')}}
                {{ Form::text('id_campaign',$objLeads->id_campaign,['class'=>'form-control'])}}  
            </div>
            <div class="col-sm-6">

                {{Form::label('lead_source_description', 'Lead Source Description')}}
                {{ Form::textarea('lead_source_description',$objLeads->lead_source_description,['class'=>'form-control'])}}   
                {{Form::label('referred_by', 'Referred By')}}
                {{ Form::text('referred_by',$objLeads->referred_by,['class'=>'form-control'])}}  
                {{Form::label('do_not_call', 'Do Not Call')}}
                {{ Form::checkbox('do_not_call','V')}}  
            </div>
        </div>
    </div>    
    <div class="tab-pane " id="O">
        <div class="form-group">
            <div class="col-sm-4">
                <?php
                if ($objLeads->allocation) {
                    ?>
                    {{ Form::hidden('id_allocation',$objLeads->allocation->id)}}  
                    <?php
                }
                $opportunity = ['Caliente' => 'Caliente', 'Tibio' => 'Tibio', 'Frio' => 'Frio'];
                ?>
                {{Form::label('opportunity', 'Opportunity')}}
                {{ Form::select('opportunity',['no-oportunity'=>'']+ $opportunity, $objLeads->opportunity,['class'=>'form-control']) }}  
                {{Form::label('id_employee', 'Assigned to')}}
                <?php
                if (Auth::user()->typeUser->name === 'Admin') {
                    $selectEmployee = Employee::select(DB::raw('id'), DB::raw('concat (first_name," ",last_name) as name'))->where('active', '=', '1')->lists('name', 'id');
                    ?>                
                    {{Form::select('id_employee',['0'=>'']+$selectEmployee,$objLeads->id_employee,['class'=>'form-control'] ) }}
                    <?php
                } else {
                    ?>
                    {{ Form::hidden('id_employee',Auth::user()->employee->id)}}
                    {{ Form::text('name_employee',Auth::user()->employee->first_name.' '.Auth::user()->employee->last_name,['class'=>'form-control','readonly'=>'readonly'])}}
                    <?php
                }
                ?>
            </div>
        </div>

    </div>     
</div>
{{ Form::close() }}
<div class="panel panel-default" id="content-logs">
    <div class="panel-heading">
        <h4>LOGS</h4>        
    </div>
    <div class="panel-body">        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Time Start</th>
                    <th>Time End</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody> 
                <?php
                $id_logs = $objLeads->logs->id;
                $status = $objLeads->logs->status;
                $activities = Logs::find($id_logs)->activities;
                foreach ($activities as $a) {
                    ?>
                    <tr>
                        <td>{{$a->name}}</td>
                        <td>{{$a->pivot->date_entered}}</td>
                        <td>{{$a->pivot->time_start}}</td>
                        <td>{{$a->pivot->time_end}}</td>   
                        <td>{{$a->pivot->description}}</td>   
                        <td></td>                           
                    </tr>
                    <?php
                }
                if ($status > 0) {
                    $activity = Activity::lists('name', 'id');
                    ?>
                    <tr>
                        {{ Form::hidden('id_logs',$id_logs)}}
                        <td>{{ Form::select('id_activity',[''=>'']+$activity, null,['class'=>'form-control']) }} </td>
                        <td>{{ Form::text('date_entered','',['class'=>'form-control default-dtp'])}}</td>
                        <td>{{ Form::text('time_start','',['class'=>'form-control hours-tp'])}}</td>
                        <td>{{ Form::text('time_end','',['class'=>'form-control hours-tp'])}}</td>                    
                        <td>{{ Form::textarea('description','',['class'=>'form-control'])}}</td>                    
                        <td><a href="{{URL::to($mod.'/logs-activity/save')}}" class="save-activity">Save</a></td>
                    </tr> 

                    <?php
                }
                ?>
            </tbody>
        </table>
        <div id="data-end-visit" class="row hidden">
            <div class="col-sm-12">
                <b>End Visit Description</b>
                {{ Form::open(array('url' => $mod.'/end-visit','class'=>'form-horizontal','id'=>'end-visit-form')) }}
                {{ Form::hidden('id_logs',$id_logs)}}
                {{ Form::textarea('description','',['class'=>'form-control'])}}
                <br>
                {{ Form::submit('Confirm',['class'=>'btn btn-default pull-right'])}}                    
                {{ Form::close() }}
            </div>               
        </div>
        <?php if ($status > 0) { ?>
            <a href="#" id="show-data-end-visit" ><span class="btn btn-default pull-right">End Visit</span></a>
        <?php } else { ?>
            <div class="well">{{$objLeads->logs->description}}</span></div>
        <?php } ?>
    </div><!--/panel-body-->
</div>
@stop
