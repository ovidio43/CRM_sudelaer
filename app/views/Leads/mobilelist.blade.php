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
                    <td>{{$rowL->allocation==true?$rowL->allocation->employee->first_name . ' ' . $rowL->allocation->employee->last_name:'undefined'}}</td>       
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="{{URL::to($mod.'/my'.Session::get('list'))}}" class="btn btn-primary">CANCEL</a>
    <button type="button" class="btn btn-success" data-dismiss="modal">CONTINUE</button>
    <?php
}

