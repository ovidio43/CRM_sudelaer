<?php
$ObjLeads = Leads::where('type', '=', 'leads')->where('mobile', '=', $mobile)->get();
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
                            if ($rowL->allocation->employee->id == Auth::user()->employee->id) {
                                ?>
                                <a href="{{URL::to('leads/edit/'.$rowL->id)}}" target="_blank" title="GO TO LEADS"><span  class="glyphicon glyphicon-new-window"></span></a>
                                <?php
                            } else {
                                echo $rowL->allocation->employee->first_name . ' ' . $rowL->allocation->employee->last_name;
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
    <a href="{{URL::to($mod.'/my'.Session::get('list'))}}" class="btn btn-primary">CANCEL</a>
    <button type="button" class="btn btn-success" data-dismiss="modal">CONTINUE</button>
    <?php
}

