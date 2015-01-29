@extends('sidebar')
@section('title')
<strong>MESSAGES</strong>
@stop
@section('content')
<form id="from-notification" action="/send-trash" method="post">
    <table class="table table-condensed table-hover">   
        <thead> 
            <tr >
                <td><input type="checkbox" name="selected-all" id="selected-all"></a></td>
                <td colspan="3"><button type="submit" id="btn-del-notification" class="btn btn-danger" style="display: none;"><span class="glyphicon glyphicon-trash"></span></button></td>                    
            </tr>
        </thead>
        <tbody>
            <?php
            $status = '1';
            $objNotification = Notification::where('id_user_destination', '=', Auth::user()->id)->where('status', '=', $status)->orderBy('date_entered', 'DESC')->paginate(20);
            foreach ($objNotification as $rowN) {
                ?>
                <tr <?= $rowN->read < 1 ? 'class="no-read active"' : ''; ?>>
                    <th scope="row">
                        <input type="checkbox" name="id_notification[]" value="{{$rowN->id}}" class="message-check">
                    </th>
                    <td><a href="{{URL::to('single/'.$rowN->id)}}">{{$rowN->subject}}</a></td>                   
                    <td>{{substr($rowN->message, 0, 20)}}...</td>                   
                    <td>{{$rowN->date_entered}}</td>                   
                </tr>  
                <?php
            }
            ?>  
        </tbody>
    </table>
</form>
{{ $objNotification->links(); }}
@stop


