@extends('sidebar')
@section('title')
NEW CONTACT
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
{{ Form::open(array('url' => 'contacts/new/save','class'=>'form-horizontal')) }}
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
                {{Form::label('email_address', 'Email Address')}} <span class="required-field">*</span>
                {{ Form::text('email_address','',['class'=>'form-control'])}}  
                {{Form::label('account_name', 'Account Name')}}
                {{ Form::text('account_name','',['class'=>'form-control'])}}
                <!--                {{Form::label('title', 'Title')}}
                                {{ Form::text('title','',['class'=>'form-control'])}}-->
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
                <!--{{ Form::text('primary_address_state','',['class'=>'form-control'])}}-->
                <select name="primary_address_state" id="primary_address_state" class="form-control">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
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
                <!--{{ Form::text('alt_address_state','',['class'=>'form-control'])}}-->

                <select name="alt_address_state" id="alt_address_state" class="form-control">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>

                {{Form::label('alt_address_zipcode', 'Alt Address Zip Code')}}
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

                {{Form::label('reports_to', 'Reports to')}}
                {{ Form::text('reports_to','',['class'=>'form-control'])}}                
                {{Form::label('lead_type', 'Lead Type')}}
                {{ Form::select('lead_type', $leadType, null,['class'=>'form-control']) }} 
                {{Form::label('lead_source', 'Lead source')}}
                {{ Form::select('lead_source', $leadSource, null,['class'=>'form-control']) }}  
                {{Form::label('id_campaign', 'Campaign')}}
                {{ Form::text('id_campaign','',['class'=>'form-control'])}}
            </div>
            <div class="col-sm-6">
                {{Form::label('sync_to_outlook', 'Sync to Outlook')}}
                {{ Form::checkbox('sync_to_outlook','V')}} 
                <br>
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
    <div class="tab-pane active" id="tab-pane-5">
        <div class="form-group"> 
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
