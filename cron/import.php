<?php

include ('config.php');
/* * *****creando campos para llenar********** */
$stringFields = strtolower('"CustomerID","Primary Buyer First Name","Primary Buyer Last Name","Primary Buyer Date of Birth","Primary Buyer Address Line 1","Primary Buyer City","Primary Buyer State/Province","Primary Buyer Postal Code","Primary Buyer Email Address","Primary Buyer Work Phone","Primary Buyer Home Phone","Vehicle Make","Vehicle Model","Vehicle Year","Vehicle VIN/Serial","Vehicle Series","Vehicle Exterior Color","Vehicle Interior Color","Vehicle Number of Cylinders","Vehicle Miles","Vehicle Stock Number","Payment Term","Payment Type (Purchase/Lease)","Sale Price","Trade In 1 Make","Trade In 1 Model","Trade In 1 Year","Trade In 1 VIN/Serial","Trade In 1 Series","Trade In 1 Exterior Color","Trade In 1 Engine Description","Trade In 1 Miles","Trade In 1 Stock Number","Trade In 1 ACV","Vehicle New/Used","Primary Salesperson ID","Deal Date","Deal Number","Current Balance","Total PTD","DMS Quote ID","Secondary Salesperson ID","Bank Name","APR/Finance Rate","Lease Money Factor","Monthly Payment","Lease Monthly Payment","Extended Warranty Price","Extended Warranty Miles","Deal Category (WS/DT/Retail)","Deal Status (Pend/Sold/Clsd)","Primary Buyer Cell Phone","Primary Buyer Address Line 2","Co-Buyer First Name","Co-Buyer Last Name","Co-Buyer Address Line 1","Co-Buyer City","Co-Buyer State/Province","Co-Buyer Postal Code","Co-Buyer Home Phone","FI Back Gross","Commissionable Gross","Vehicle Service Contract Price","Co-Buyer Date of Birth","Trade In 1 Allowance","Trade In 1 Payoff","Trade In 2 Make","Trade In 2 Model","Trade In 2 Series","Trade In 2 Year","Trade In 2 VIN/Serial","Trade In 2 Exterior Color","Trade In 2 Stock Number","Trade In 2 Allowance","Trade In 2 ACV","Trade In 2 Payoff","Transmission Type","Fuel Type","Vehicle Class","Vechile Cost","Rebate","Residual","AH Insurance Premium","AH Insurance Reserve","Sales Manager ID","Finance Manager ID","Total Aftermarket Price","Total Aftermarket Reserve","Gap","Gap Reserve","Finance Reserve","Down Payment","Holdback","Life Insurance Premium","Life Insurance Reserve","Top/Sales Gross","VSC Reserve","House Gross","Pack","Service Maintenance Miles","Service Maintenance Term","Service Maintenance Plan","Delivery Date","Reversal Date","Status Date","Commissionable Cost","Extended Warranty Reserve","GL Balance","List Price","MSRP","Net Cap Cost","Total Amount Financed","Aftermarket Incentive","Co-buyer Email Address","Co-buyer Middle Name","Co-buyer Mobile Phone","Country","Engine Size","Inventive","Primary Buyer Middle Name","Trade In 2 Miles","Trade In Net Trade Amount","Trade In 2 Net Trade Amount","Trim","Mailing Address First Name","Street Address Line 3","Estimated Delivery Date","Ext Warranty Contract Number","Ext Warranty Exp Date","Veh Service Contract Number","Veh Service Contract Exp Date","Additional Note 1","Inventory Company","Additional Fee 1","Additional Fee 2","Additional Fee 3","Additional Fee 4","Additional Fee 5","Additional Fee 6","Additional Fee 7","Additional Fee 8","Additional Fee 9","Additional Fee 10","Addition to Cap Cost 1","Addition to Cap Cost 2","Addition to Cap Cost 3","Addition to Cap Cost 4","Addition to Cap Cost 5","Addition to Cap Cost 6","Addition to Cap Cost 7","Annual Fee 1","Annual Fee 2","Annual Fee 3","Annual Fee 4","Annual Fee 5","Initial Fee 1","Initial Fee 2","Initial Fee 3","Initial Fee 4","Initial Fee 5","Initial Fee 6","Initial Fee 7","Initial Fee 8","Initial Fee 9","Initial Fee 10","License Plate"');
$charToReplace = ['(', ')', '-', '/', ' '];
$fields = str_replace('"', '`', $stringFields); //reemplazandno doble comilla por nada
$fields = str_replace($charToReplace, '_', $fields); //reemplazandno caqracteres por guiens bajo "_"
$tempTable = 'leads_import_data_from_csv_temp';
$csvFile = __DIR__ . DIRECTORY_SEPARATOR . "../imports" . DIRECTORY_SEPARATOR . "imported-file.csv";
$query = sprintf("LOAD DATA INFILE '%s' INTO TABLE $tempTable FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n' IGNORE 0 LINES ($fields)", addslashes($csvFile));
$db->query($query);

$query = "UPDATE $tempTable SET co_buyer_mobile_phone = REPLACE(co_buyer_mobile_phone, '-', '')"; //reeemplazando el - por nada
$db->query($query);
$query = "delete from $tempTable where id=1"; //eliminar primer campo porque inserta nombre de campos [NO BORRAR]
$db->query($query);

/* * *********insertando datos nuevos desde tabla temporal  a la tabla maestra******************** */


$masterTable = 'leads_import_data_from_csv';
$query = "INSERT INTO $masterTable ($fields) (SELECT $fields FROM $tempTable where customerid not in (select customerid from $masterTable))";
$db->query($query);

$query = 'TRUNCATE leads_import_data_from_csv_temp';
$db->query($query);



/* * *****************procedimientos para crear tabla ********************** */
//    $stringTable = "CREATE TABLE IF NOT EXISTS `leads_import_data_from_csv` ("
//            . "`id` int(10) unsigned NOT NULL AUTO_INCREMENT,";
//    foreach (explode(', ', $fields) as $value) {
//        $stringTable.=$value . ' varchar(120) COLLATE utf8_unicode_ci NOT NULL, ';
//    }    
//    $stringTable.= 'PRIMARY KEY (`id`)'
//            . ') ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT = 1;';
//    echo $stringTable;
