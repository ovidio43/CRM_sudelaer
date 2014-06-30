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
<ul class="nav nav-tabs">
    <li class="active"><a href="#" id="1">Lead Information</a></li>    
    <li><a href="#" id="2">Address Information</a></li>    
    <li><a href="#" id="3">More Information</a></li>    
    <li><a href="#" id="4">Other</a></li>    
    <li><a href="#" id="5">Car Type</a></li>    
</ul> 
{{ Form::open(array('url' => 'leads/new/save','class'=>'form-horizontal')) }}
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
                {{ Form::select('salutation',$salutation, null,['class'=>'form-control']) }}                
                {{Form::label('first_name', 'First Name')}} <span class="required-field">*</span>                
                {{ Form::text('first_name','',['class'=>'form-control'])}}
                {{Form::label('last_name', 'Last Name')}} <span class="required-field">*</span>
                {{ Form::text('last_name','',['class'=>'form-control'])}}
                <!--                {{Form::label('title', 'Title')}}
                                {{ Form::text('title','',['class'=>'form-control'])}}-->
                {{Form::label('email_address', 'Email Address')}} <span class="required-field">*</span>
                {{ Form::text('email_address','',['class'=>'form-control'])}} 
                {{Form::label('account_name', 'Account Name')}}
                {{ Form::text('account_name','',['class'=>'form-control'])}}
            </div>  
            <div class="col-sm-4">
                <!--                {{Form::label('department', 'Departament')}}
                                {{ Form::text('department','',['class'=>'form-control'])}}-->
                {{Form::label('home_phone', 'Home Phone')}}
                {{ Form::text('home_phone','',['class'=>'form-control'])}}
                {{Form::label('office_phone', 'Office Phone')}}
                {{ Form::text('office_phone','',['class'=>'form-control'])}}
                {{Form::label('mobile', 'Mobile')}}
                {{ Form::text('mobile','',['class'=>'form-control'])}}
                {{Form::label('fax', 'Fax')}}
                {{ Form::text('fax','',['class'=>'form-control'])}}
            </div> 
            <div class="col-sm-4">               

                <!--                {{Form::label('website', 'Website')}}
                                {{ Form::text('website','',['class'=>'form-control'])}}                -->
            </div> 
        </div>
    </div>    
    <div class="tab-pane " id="tab-pane-2">
        <div class="form-group">
            <div class="col-sm-6">
                {{Form::label('primary_address_street', 'Primary Address Street')}}
                {{ Form::textarea('primary_address_street','',['class'=>'form-control'])}}
                {{Form::label('primary_address_city', 'Primary Address City')}}
                {{ Form::text('primary_address_city','',['class'=>'form-control'])}}
                {{Form::label('primary_address_state', 'Primary Address State')}}
                {{ Form::text('primary_address_state','',['class'=>'form-control'])}}
                {{Form::label('primary_address_zipcode', 'Primary Address Zip Code')}}
                {{ Form::text('primary_address_zipcode','',['class'=>'form-control'])}}
                <!--                {{Form::label('primary_address_country', 'Primary Address Country')}}
                                {{ Form::text('primary_address_country','',['class'=>'form-control'])}}-->
            </div>
            <div class="col-sm-6">
                {{Form::label('alt_address_street', 'Alt Address Street')}}
                {{ Form::textarea('alt_address_street','',['class'=>'form-control'])}}
                {{Form::label('alt_address_city', 'Alt Address City')}}
                {{ Form::text('alt_address_city','',['class'=>'form-control'])}}
                {{Form::label('alt_address_state', 'Alt  Address State')}}
                {{ Form::text('alt_address_state','',['class'=>'form-control'])}}
                {{Form::label('alt_address_zipcode', 'Alt Address Postalcode')}}
                {{ Form::text('alt_address_zipcode','',['class'=>'form-control'])}}
                <!--                {{Form::label('alt_address_country', 'Alt Address Country')}}
                                {{ Form::text('alt_address_country','',['class'=>'form-control'])}}-->
                {{Form::label('copy', 'Copy address from left')}}
                {{ Form::checkbox('copy') }}
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-4">

                {{Form::label('note', 'Note')}}
                {{ Form::textarea('note','',['class'=>'form-control'])}}                 
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
                {{ Form::select('status', $status, null,['class'=>'form-control']) }}                 
                {{Form::label('status_description', 'Status Description')}}
                {{ Form::textarea('status_description','',['class'=>'form-control'])}}   
                {{Form::label('opportunity_amount', 'Opportunity Amount')}}
                {{ Form::text('opportunity_amount','',['class'=>'form-control'])}}  
                {{Form::label('id_campaign', 'Campaign')}}
                {{ Form::text('id_campaign','',['class'=>'form-control'])}}  
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
                {{ Form::select('lead_type', $leadType, null,['class'=>'form-control']) }} 
                {{Form::label('lead_source', 'Lead source')}}
                {{ Form::select('lead_source', $leadSource, null,['class'=>'form-control']) }}                 
                {{Form::label('lead_source_description', 'Lead Source Description')}}
                {{ Form::textarea('lead_source_description','',['class'=>'form-control'])}}   
                {{Form::label('referred_by', 'Referred By')}}
                {{ Form::text('referred_by','',['class'=>'form-control'])}}  
                {{Form::label('do_not_call', 'Do Not Call')}}
                {{ Form::checkbox('do_not_call','V')}}  
            </div>
        </div>
    </div>    
    <div class="tab-pane " id="tab-pane-4">
        <div class="form-group">
            <div class="col-sm-4">
                {{Form::label('id_employee', 'Assigned to')}}
                {{ Form::text('id_employee','',['class'=>'form-control'])}}  
                <hr>
                {{ Form::submit('Save',['class'=>'btn btn-default'])}}
            </div>
        </div>
    </div> 
    <div class="tab-pane " id="tab-pane-5">
        <div class="form-group">

        </div>
    </div>
</div>
{{ Form::close() }}
@stop
