{{ Form::open(array('url' => null)) }}
<div class="form-group">
    {{Form::label('sms-mobile', 'Mobile')}}
    {{ Form::text('sms-mobile',$mobile,['class'=>'form-control','id'=>'sms-mobile','readonly'=>'readonly'])}}       
</div>
<div class="form-group">
    {{Form::label('sms-subject', 'Subject')}}
    {{ Form::text('sms-subject','',['class'=>'form-control','id'=>'sms-subject','placeholder'=>'Subject'])}}       
</div>
<div class="form-group">
    {{Form::label('sms-message', 'Message')}}<small> (All languages are supported) Char Left: 0/120</small>
    {{ Form::textarea('sms-message','',['class'=>'form-control','placeholder'=>'Message'])}}
</div>    
<!--<button type="submit" class="btn btn-default">Send</button>-->
{{ Form::close() }}