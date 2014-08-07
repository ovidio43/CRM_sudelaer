<?php

include ('config.php');
$query = "SELECT title,name,first_name,user,email FROM "
        . "alert a INNER JOIN alert_type_user atu ON atu.id_alert=a.id"
        . " INNER JOIN type_user tu ON tu.id=atu.id_type_user"
        . " INNER JOIN user u ON u.id_type_user=tu.id"
        . " INNER JOIN employee e ON e.id=u.id_employee"
        . " WHERE a.id=2 AND e.id !=1";
$objEmp = $db->get_results($query);
if ($objEmp) {
    $message = $links = '';
    $mail->Subject = "Unsigned leads";
    foreach ($objEmp as $row) {
        $diferencia = strtotime(date('Y-m-d H:i:s')) - strtotime($row->date_entered);
        if ($diferencia > 3600) {
            $mail->AddAddress($row->email, $row->first_name);
        }
    }
    $query = "SELECT * FROM leads WHERE type = 'leads' and id_employee = 0 ORDER BY date_entered DESC";
    $objLeads = $db->get_results($query);
    foreach ($objLeads as $row) {
        $links.='http://www.sudealeramigo.com/crm/leads/edit/' . $row->id . '  | Entered:' . $row->date_entered . '<br>';
    }
    $message .= 'There are ' . count($objLeads) . ' leads who have not yet assigned. <br><br>';
    $message .=$links;
    $mail->MsgHTML($message);
    $mail->Send();
}




