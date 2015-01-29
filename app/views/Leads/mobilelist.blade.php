<?php
if ($id_leads > 0) {
    $ObjLeads = Leads::where('type', '=', 'leads')->where('mobile', '=', $mobile)->where('id', '!=', $id_leads)->get();
} else {
    $ObjLeads = Leads::where('type', '=', 'leads')->where('mobile', '=', $mobile)->get();
}

if (count($ObjLeads) > 0) {
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Assigned to</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ObjLeads as $rowL) {
                ?>
                <tr>
                    <td>{{$rowL->first_name.' '.$rowL->last_name}}</td>
                    <td>{{$rowL->email_address}}</td>
                    <td>
                        <?php
                        if ($rowL->allocation) {
                            $id_employee = $rowL->allocation->employee->id;
                            $objUser = User::where('id_employee', '=', $id_employee)->get();                            
                            if ($id_employee == Auth::user()->employee->id) {
                                ?>
                                <a href="{{URL::to('leads/edit/'.$rowL->id)}}" target="_blank" title="GO TO LEADS"><span  class="glyphicon glyphicon-new-window"></span></a>
                                <?php
                            } else {
                                echo $rowL->allocation->employee->first_name . ' ' . $rowL->allocation->employee->last_name;
                                ?>
                                <a href="{{URL::to('notification-form')}}" class="link-send-notification" title="SEND NOTIFICATION" ><span  class="glyphicon glyphicon-send"></span></a>
                                <div style="display: none;">   
                                    {{ Form::open(array('url' => 'notification-save','id'=>'notification-form')) }}
                                    {{Form::hidden('id_leads',$rowL->id)}}                                    
                                    {{Form::hidden('id_user_destination',$objUser[0]->id)}}
                                    <div class="form-group">
                                        {{Form::label('subject', 'Subject')}}
                                        {{Form::text('subject', '',['class'=>'form-control','placeholder'=>'Enter Subject'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('message', 'Message')}}
                                        {{Form::textarea('message', '',['class'=>'form-control','placeholder'=>'Enter Message','rows'=>'0'])}}
                                    </div>
                                    <!--<input type="submit" value="send">-->
                                    <button type="submit" class="btn btn-info" ><span  class="glyphicon glyphicon-send"></span> Send Notification</button>
                                    {{ Form::close() }} 
                                </div>
                                <?php
                            }
                        } else {
                            echo 'undefined';
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="{{URL::to($mod.'/my'.Session::get('list'))}}" class="btn btn-danger"><span  class="glyphicon glyphicon-remove"></span> CANCEL</a>
    <button type="button" class="btn btn-success" data-dismiss="modal"><span  class="glyphicon glyphicon-ok"></span> CONTINUE</button>
    <?php
}

