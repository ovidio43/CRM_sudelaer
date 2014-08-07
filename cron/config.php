<?php

require 'PHPMailer/PHPMailerAutoload.php';
include_once "ezSQL/shared/ez_sql_core.php";
include_once "ezSQL/mysql/ez_sql_mysql.php";
//$db = new ezSQL_mysql('cgimport_crmimp', 'yzwb$kt#SAuD', 'cgimport_dbcrmimports', 'localhost');
$db = new ezSQL_mysql('root', '', 'db_innervel1_1', 'localhost');

/* * *******setting mail************* */
$mail = new PHPMailer();
$mail->IsSMTP();
//    $mail->SMTPDebug = 2;
$mail->SMTPAuth = true;
$mail->Host = "mail.sudealeramigo.com";
$mail->SMTPSecure = "tls";
$mail->Port = 26;
$mail->Username = "crmalerts@sudealeramigo.com";
$mail->Password = "2KW2q+?[^LSr";
$mail->SetFrom("crmalerts@sudealeramigo.com", "crm-alerts");
/*     * ********************* */

