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
    <li class="active"><a href="#LA"  role="tab" data-toggle="tab">Lead Information</a></li>    
    <li><a href="#AI"  role="tab" data-toggle="tab">Address Information</a></li>    
    <li><a href="#MI"  role="tab" data-toggle="tab">More Information</a></li>    
    <li><a href="#O"  role="tab" data-toggle="tab">Other</a></li>    
    <li class="disabled"><a href="#">Car Type</a></li>    
</ul> 
{{ Form::open(array('url' => $mod.'/new/save','class'=>'form-horizontal')) }}
{{ Form::submit('Save',['class'=>'btn btn-primary custom-save-button'])}}
<div class="tab-content">
    <div class="tab-pane active" id="LA">
        <div class="form-group">            
            <div class="col-sm-4"> 
                <?php
                $salutation = [
                    'Mr.' => 'Mr.',
                    'Ms.' => 'Ms.',
                    'Mrs.' => 'Mrs.',
                    'Dr.' => 'Dr.',
                    'Prof.' => 'Prof.'
                ];

                $leadSource = [
                    '' => '',
                    'Univision Washington' => 'Univision Washington',
                    'DContigo Tv Show' => 'DContigo Tv Show',
                    'Telemundo Washington' => 'Telemundo Washington',
                    'Radio Lanueva87.7' => 'Radio Lanueva87.7',
                    'Variedades de Washington' => 'Variedades de Washington',
                    'Referido' => 'Referido',
                    'Cliente actual' => 'Cliente actual',
                    'Periodicos' => 'Periodicos',
                    'Revistas' => 'Revistas',
                    'Cliente Antiguo' => 'Cliente Antiguo',
                    'Otros' => 'Otros'
                ];

                $leadType = [
                    '' => '',
                    'Phone in' => 'Phone in',
                    'Walk in' => 'Walk in',
                    'Web' => 'Web'
                ];
                ?>
                {{Form::label('salutation', 'Salutation')}}
                {{ Form::select('salutation',$salutation, null,['class'=>'form-control']) }}                
                {{Form::label('first_name', 'First Name')}} <span class="required-field">*</span>                
                {{ Form::text('first_name','',['class'=>'form-control'])}}
                {{Form::label('last_name', 'Last Name')}} <span class="required-field">*</span>
                {{ Form::text('last_name','',['class'=>'form-control'])}}              
                {{Form::label('email_address', 'Email Address')}} 
                {{ Form::text('email_address','',['class'=>'form-control','id'=>'email_address'])}} 
                <a href="#" onclick="capturarValorEmail()"  id="myEmailLink" class="thickbox">
                    <img title="Verify email address" src="{{ URL::asset('img/email.png')}}" width="25px" heigth="25px">
                </a>

                <!--{{Form::label('account_name', 'Account Name')}}-->
                <!--{{ Form::text('account_name','',['class'=>'form-control'])}}-->
                {{Form::label('lead_type', 'Lead Type')}}<span class="required-field">*</span>
                {{ Form::select('lead_type', $leadType, null,['class'=>'form-control']) }} 

            </div>  
            <div class="col-sm-4">
                {{Form::label('lead_source', 'Lead source')}}<span class="required-field">*</span>
                {{ Form::select('lead_source', $leadSource, null,['class'=>'form-control']) }}  
                {{Form::label('home_phone', 'Home Phone')}}
                {{ Form::text('home_phone','',['class'=>'form-control'])}}
                <!--{{Form::label('office_phone', 'Office Phone')}}-->
                <!--{{ Form::text('office_phone','',['class'=>'form-control'])}}-->
                {{Form::label('mobile', 'Mobile')}}<span class="required-field">*</span>
                {{ Form::text('mobile','',['class'=>'form-control','id'=>'mobile'])}}
                <a href="#" onclick="capturarValorPhone()"  id="myPhoneLink" class="thickbox hidden">
                    <img title="Verify phone number" src="{{ URL::asset('img/phone.png')}}" width="25px" heigth="25px">
                </a>
                <!--{{Form::label('fax', 'Fax')}}-->
                <!--{{ Form::text('fax','',['class'=>'form-control'])}}-->

            </div>  

            <div class="col-sm-4">
                {{Form::label('note', 'Note')}}
                {{ Form::textarea('note','',['class'=>'form-control'])}} 
            </div>
        </div>    
    </div>    
    <div class="tab-pane " id="AI">
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
                {{ Form::textarea('primary_address_street','',['class'=>'form-control'])}}
                {{Form::label('primary_address_city', 'Primary Address City')}}
                {{ Form::text('primary_address_city','',['class'=>'form-control'])}}
                {{Form::label('primary_address_state', 'Primary Address State')}}
                {{ Form::select('primary_address_state',$selectState, null,['class'=>'form-control']) }}                                  
                {{Form::label('primary_address_zipcode', 'Primary Address Zip Code')}}
                {{ Form::text('primary_address_zipcode','',['class'=>'form-control'])}}               
            </div>
            <div class="col-sm-6">
                {{Form::label('alt_address_street', 'Alt Address Street')}}
                {{ Form::textarea('alt_address_street','',['class'=>'form-control'])}}
                {{Form::label('alt_address_city', 'Alt Address City')}}
                {{ Form::text('alt_address_city','',['class'=>'form-control'])}}
                {{Form::label('alt_address_state', 'Alt  Address State')}}
                {{ Form::select('alt_address_state',$selectState, null,['class'=>'form-control']) }}                   
                {{Form::label('alt_address_zipcode', 'Alt Address Postalcode')}}
                {{ Form::text('alt_address_zipcode','',['class'=>'form-control'])}}               
                {{Form::label('copy', 'Copy address from left')}}
                {{ Form::checkbox('copy') }}
            </div>
        </div>

    </div>    
    <div class="tab-pane " id="MI">
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
                {{Form::label('lead_source_description', 'Lead Source Description')}}
                {{ Form::textarea('lead_source_description','',['class'=>'form-control'])}}   
                {{Form::label('referred_by', 'Referred By')}}
                {{ Form::text('referred_by','',['class'=>'form-control'])}}  
                {{Form::label('do_not_call', 'Do Not Call')}}
                {{ Form::checkbox('do_not_call','V')}}  
            </div>
        </div>
    </div>    
    <div class="tab-pane " id="O">
        <div class="form-group">
            <div class="col-sm-4">
                <?php
                $opportunity = [                    
                    'Caliente' => 'Caliente',
                    'Tibio' => 'Tibio',
                    'Frio' => 'Frio'];
                ?>
                {{Form::label('opportunity', 'Opportunity')}}
                {{ Form::select('opportunity',['no-asigned'=>'']+ $opportunity, null,['class'=>'form-control']) }}  



                <?php
                if (Auth::user()->typeUser->name === 'Admin') {
                    $selectEmployee = Employee::select(DB::raw('id'), DB::raw('concat (first_name," ",last_name) as name'))->where('active', '=', '1')->lists('name', 'id');
                    ?>    
                    {{Form::label('id_employee', 'Assigned to')}}
                    {{Form::select('id_employee',['0'=>'']+$selectEmployee,null,['class'=>'form-control'] ) }}
                    <?php
                } else {
                    ?>
                    <!--{{ Form::hidden('id_employee',Auth::user()->employee->id)}}-->
                    {{ Form::hidden('id_employee','0')}}
                    <!--{{ Form::text('name_employee',Auth::user()->employee->first_name.' '.Auth::user()->employee->last_name,['class'=>'form-control','readonly'=>'readonly'])}}-->
                    <?php
                }
                ?>
            </div>
        </div>

    </div>  
</div>
{{ Form::close() }}
@stop
