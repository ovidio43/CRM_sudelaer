@extends('sidebar')
@section('title')

@stop
@section('content')
<div class="container-fluid">
    <?php
    $objNotification = Notification::find($id_notification);
     $objUserSource = User::find($objNotification->id_user_source);
    if ($objNotification->read == '0') {
        $objNotification->read = '1';
        $objNotification->save();
    }
    ?>
    <div class="page-header">
        <h1><small>{{$objNotification->subject}}</small></h1>
    </div>
    <pre>{{$objNotification->message}} <a href="{{URL::to('leads/edit/'.$objNotification->id_leads)}}"><span class="glyphicon glyphicon-new-window"></span></a></pre>
    <small><strong>Send:</strong> {{$objNotification->date_entered}}</small><br>
    <small><strong>From:</strong> {{$objUserSource->employee->first_name.' '.$objUserSource->employee->last_name}}</small>
</div>
@stop


