<?php
//$phone = $_REQUEST['phone'];
//if ($phone == '') {
//    $phone = '0000000000';
//}
$url = "https://api.opencnam.com/v2/phone/+$phone?format=xml";

if (@simplexml_load_file($url)) {
    $myXml = @simplexml_load_file($url);
    $number = $myXml->number;
    $name = $myXml->name;
} else {
    $number = "Not found";
    $name = "";
}
?>
<html>
    <head>
        <title>OPEN CNAM</title>
        <link href="../../styles/myLightbox.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <myLabel><?php echo $number; ?></myLabel>
    <myData><?php echo $name; ?></myData>
</body>
</html>