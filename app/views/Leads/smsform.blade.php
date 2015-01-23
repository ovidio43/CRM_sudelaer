{{ Form::open(array('url' => 'send-sms','class'=>'global-form')) }}
{{ Form::hidden('id_leads',$id_leads)}}
<div class="form-group">
    {{Form::label('mobile', 'Mobile')}}
    {{ Form::text('mobile',$mobile,['class'=>'form-control','id'=>'mobile','readonly'=>'readonly'])}}       
</div>
<div class="form-group">
    {{Form::label('subject', 'Subject')}}
    {{ Form::text('subject','',['class'=>'form-control','id'=>'subject','placeholder'=>'Subject'])}}       
</div>
<div class="form-group">
    {{Form::label('message', 'Message')}}<small> (All languages are supported) Char Left: 0/120</small>
    {{ Form::textarea('message','',['class'=>'form-control','placeholder'=>'Message'])}}
</div>    
<input type="submit" class="btn btn-default " value="Send">
{{ Form::close() }}