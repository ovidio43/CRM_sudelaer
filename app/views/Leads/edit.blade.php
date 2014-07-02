@extends('sidebar')
@section('title')
NEW LEADS
@stop
@section('content')
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
<?php
$objLeads = Leads::find($id);
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#" id="1">Lead Information</a></li>    
    <li><a href="#" id="2">Address Information</a></li>    
    <li><a href="#" id="3">More Information</a></li>    
    <li><a href="#" id="4">Other</a></li>    
    <li><a href="#" id="5">Car Type</a></li>    
</ul> 
{{ Form::open(array('url' => 'leads/edit-save/'.$objLeads->id,'class'=>'form-horizontal')) }}
<input type="hidden" name="action" value="update">
<div class="tab-content">
    <div class="tab-pane active" id="tab-pane-1">
        <div class="form-group">            
            <div class="col-sm-4"> 
                <?php
                $salutation = [
                    'Mr.' => 'Mr.',
                    'Ms.' => 'Ms.',
                    'Mrs.' => 'Mrs.',
                    'Dr.' => 'Dr.',
                    'Prof.' => 'Prof.'
                        ]
                ?>
                {{Form::label('salutation', 'Salutation')}}
                {{ Form::select('salutation',$salutation, $objLeads->salutation,['class'=>'form-control']) }}                
                {{Form::label('first_name', 'First Name')}} <span class="required-field">*</span>                
                {{ Form::text('first_name',$objLeads->first_name,['class'=>'form-control'])}}
                {{Form::label('last_name', 'Last Name')}} <span class="required-field">*</span>
                {{ Form::text('last_name',$objLeads->last_name,['class'=>'form-control'])}}                
                {{Form::label('email_address', 'Email Address')}} <span class="required-field">*</span>
                {{ Form::text('email_address',$objLeads->email_address,['class'=>'form-control'])}} 
                {{Form::label('account_name', 'Account Name')}}
                {{ Form::text('account_name',$objLeads->account_name,['class'=>'form-control'])}}
            </div>  
            <div class="col-sm-4">
                {{Form::label('home_phone', 'Home Phone')}}
                {{ Form::text('home_phone',$objLeads->home_phone,['class'=>'form-control'])}}
                {{Form::label('office_phone', 'Office Phone')}}
                {{ Form::text('office_phone',$objLeads->office_phone,['class'=>'form-control'])}}
                {{Form::label('mobile', 'Mobile')}}
                {{ Form::text('mobile',$objLeads->mobile,['class'=>'form-control'])}}
                {{Form::label('fax', 'Fax')}}
                {{ Form::text('fax',$objLeads->fax,['class'=>'form-control'])}}
            </div>             
        </div>
    </div>    
    <div class="tab-pane " id="tab-pane-2">
        <div class="form-group">
            <div class="col-sm-6">
                <?php
                $selectState = [
                    'AL' => "Alabama",
                    'AK' => "Alaska",
                    'AZ' => "Arizona",
                    'AR' => "Arkansas",
                    'CA' => "California",
                    'CO' => "Colorado",
                    'CT' => "Connecticut",
                    'DE' => "Delaware",
                    'DC' => "District Of Columbia",
                    'FL' => "Florida",
                    'GA' => "Georgia",
                    'HI' => "Hawaii",
                    'ID' => "Idaho",
                    'IL' => "Illinois",
                    'IN' => "Indiana",
                    'IA' => "Iowa",
                    'KS' => "Kansas",
                    'KY' => "Kentucky",
                    'LA' => "Louisiana",
                    'ME' => "Maine",
                    'MD' => "Maryland",
                    'MA' => "Massachusetts",
                    'MI' => "Michigan",
                    'MN' => "Minnesota",
                    'MS' => "Mississippi",
                    'MO' => "Missouri",
                    'MT' => "Montana",
                    'NE' => "Nebraska",
                    'NV' => "Nevada",
                    'NH' => "New Hampshire",
                    'NJ' => "New Jersey",
                    'NM' => "New Mexico",
                    'NY' => "New York",
                    'NC' => "North Carolina",
                    'ND' => "North Dakota",
                    'OH' => "Ohio",
                    'OK' => "Oklahoma",
                    'OR' => "Oregon",
                    'PA' => "Pennsylvania",
                    'RI' => "Rhode Island",
                    'SC' => "South Carolina",
                    'SD' => "South Dakota",
                    'TN' => "Tennessee",
                    'TX' => "Texas",
                    'UT' => "Utah",
                    'VT' => "Vermont",
                    'VA' => "Virginia",
                    'WA' => "Washington",
                    'WV' => "West Virginia",
                    'WI' => "Wisconsin",
                    'WY' => "Wyoming"
                ];
                ?>

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
        <div class="form-group">
            <div class="col-sm-4">

                {{Form::label('note', 'Note')}}
                {{ Form::textarea('note',$objLeads->note,['class'=>'form-control'])}}                 
            </div>
        </div>
    </div>    
    <div class="tab-pane " id="tab-pane-3">
        <div class="form-group">
            <div class="col-sm-6">                 
                <?php
                $status = ['New' => 'New',
                    'Assigned' => 'Assigned',
                    'In Process' => 'In Process',
                    'Converted' => 'Converted',
                    'Recycled' => 'Recycled',
                    'Dead' => 'Dead'];
                ?>
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
                <?php
                $leadSource = [
                    'Univision Washington' => 'Univision Washington',
                    'DContigo Tv Show' => 'DContigo Tv Show',
                    'Telemundo Washington' => 'Telemundo Washington',
                    'Radio Lanueva87.7' => 'Radio Lanueva87.7',
                    'Variedades de Washington' => 'Variedades de Washington',
                    'Referido' => 'Referido',
                    'Cliente actual' => 'Cliente actual',
                    'Periodicos' => 'Periodicos',
                    'Revistas' => 'Revistas',
                    'Otros' => 'Otros'
                ];

                $leadType = [
                    'Phone in' => 'Phone in',
                    'Walk in' => 'Walk in',
                    'Web' => 'Web'
                ];
                ?>
                {{Form::label('lead_type', 'Lead Type')}}
                {{ Form::select('lead_type', $leadType, $objLeads->lead_type,['class'=>'form-control']) }} 
                {{Form::label('lead_source', 'Lead source')}}
                {{ Form::select('lead_source', $leadSource, $objLeads->lead_source,['class'=>'form-control']) }}                 
                {{Form::label('lead_source_description', 'Lead Source Description')}}
                {{ Form::textarea('lead_source_description',$objLeads->lead_source_description,['class'=>'form-control'])}}   
                {{Form::label('referred_by', 'Referred By')}}
                {{ Form::text('referred_by',$objLeads->referred_by,['class'=>'form-control'])}}  
                {{Form::label('do_not_call', 'Do Not Call')}}
                {{ Form::checkbox('do_not_call','V')}}  
            </div>
        </div>
    </div>    
    <div class="tab-pane " id="tab-pane-4">
        <div class="form-group">
            <div class="col-sm-4">
                <?php $selectEmployee = Employee::select(DB::raw('id'), DB::raw('concat (first_name," ",last_name) as name'))->where('active', '=', '1')->lists('name', 'id'); ?>
                {{Form::label('id_employee', 'Assigned to')}}
                {{Form::select('id_employee',[''=>'']+$selectEmployee,$objLeads->id_employee,['class'=>'form-control'] ) }}

            </div>
        </div>
    </div> 
    <div class="tab-pane " id="tab-pane-5">
        <input type="hidden" id="aux" value="0">
        <?php
        $objCarType = CarType::where('id_leads', '=', $objLeads->id)->get();
        $i = 0;

        foreach ($objCarType as $rowCT) {
            ?>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-2">
                        <input type="hidden" name="id_carType{{$i}}" value="{{$rowCT->id}}">
                        {{Form::label('make'.$i, 'Make')}}
                        {{ Form::text('make'.$i,$rowCT->make,['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('year'.$i, 'Year')}}
                        {{ Form::text('year'.$i,$rowCT->year,['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('stock'.$i, 'Stock')}}
                        {{ Form::text('stock'.$i,$rowCT->stock,['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('budget'.$i, 'Budget')}}
                        {{ Form::text('budget'.$i,$rowCT->budget,['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-2">
                        <br>
                        <a role="button" class="btn btn-primary link-get-car-type"  href="#" rel="{{$i}}">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </div>
                </div>
            </div>  
            <?php
            $i++;
        }
        for ($c = $i; $c <= 2; $c++) {
            ?>
            <div class="form-group">
                <div class="row">                
                    <div class="col-sm-2">
                        {{Form::label('make'.$c, 'Make')}}
                        {{ Form::text('make'.$c,'',['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('year'.$c, 'Year')}}
                        {{ Form::text('year'.$c,'',['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('stock'.$c, 'Stock')}}
                        {{ Form::text('stock'.$c,'',['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-2">
                        {{Form::label('budget'.$c, 'Budget')}}
                        {{ Form::text('budget'.$c,'',['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-2">
                        <br>
                        <a role="button" class="btn btn-primary link-get-car-type"  href="#" rel="{{$c}}">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </div>
                </div>
            </div>    
            <?php
        }
        ?>
        <div class="form-group">
            <hr>
            {{ Form::submit('Save',['class'=>'btn btn-default'])}}
        </div>
    </div>
</div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Car Type</h4>
            </div>
            <div id="modal-body" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
