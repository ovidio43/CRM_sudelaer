<?php

include ('config.php');

$query = "SELECT title,name,first_name,user,email FROM "
        . "alert a INNER JOIN alert_type_user atu ON atu.id_alert=a.id"
        . " INNER JOIN type_user tu ON tu.id=atu.id_type_user"
        . " INNER JOIN user u ON u.id_type_user=tu.id"
        . " INNER JOIN employee e ON e.id=u.id_employee"
        . " WHERE a.id=3 AND e.id !=1";
$objEmp = $db->get_results($query);
if ($objEmp) {

    $message = $links = '';
    $mail->Subject = "This leads no have logs activities.";

    $to = '';
    foreach ($objEmp as $row) {
        $diferencia = strtotime(date('Y-m-d H:i:s')) - strtotime($row->date_entered);
        if ($diferencia > 7200) {
            $mail->AddAddress($row->email, $row->first_name);
        }
    }


    $query = "SELECT l.id,l.date_entered FROM leads l INNER JOIN logs lo ON l.id=lo.id_leads "
            . "INNER JOIN activity_logs al ON lo.id=al.id_logs "
            . "GROUP BY l.id";
    $objLogs = $db->get_results($query);
    $where = ' WHERE ';
    foreach ($objLogs as $row) {
        $where.='id!=' . $row->id . ' AND ';
    }


    $where = substr($where, 0, - 4);
    $query = 'SELECT * FROM leads' . $where . ' ORDER BY date_entered DESC';

    $objLeads = $db->get_results($query);
    foreach ($objLeads as $row) {
        $links.='http://www.sudealeramigo.com/crm/leads/edit/' . $row->id . ' | Entered:' . $row->date_entered . '<br>';
    }
    $message .= 'There are ' . count($objLeads) . ' leads not have records of activity.<br><br>';
    $message .=$links;
    $mail->MsgHTML($message);
    $mail->Send();
}












