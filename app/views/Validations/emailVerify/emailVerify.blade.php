<link href="../css/email.css" rel="stylesheet" type="text/css" />
<?php


$USER_ID = "luminia1489@outlook.es"; //replace this value with your StrikeIron UserID or Email Verification v6.0.0 License Key 
$PASSWORD = "a5hLC4"; //Replace this value with your StrikeIron Web Service Password; you can set this value to null if you are using a License Key

$WSDL = 'http://ws.strikeiron.com/EmailVerify6?WSDL';

// create client
$client = new SoapClient($WSDL, array('trace' => 1, 'exceptions' => 1));

// create registered user for soap header
$registered_user = array("RegisteredUser" => array("UserID" => $USER_ID, "Password" => $PASSWORD));
$header = new SoapHeader("http://ws.strikeiron.com", "LicenseInfo", $registered_user);

// set soap headers - this will apply to all operations
$client->__setSoapHeaders($header);

try {
    //Calls VerifyEmail and displayes the result
//    $myEmail = $_GET['email'];
    $myEmail = 'iprojimoi@gmail.com';

    VerifyEmail($myEmail);
} catch (Exception $ex) {
    echo $ex->getMessage() . "<br>";
}

function VerifyEmail($myEmail) {
    global $client;

    //Set up input parameters for the VerifyEmail operation
    $emailAddress = $myEmail;
    $timeout = '30';

    //set up parameter array
    $params = array("Email" => $emailAddress,
        "Timeout" => $timeout,
    );

    //call the web service operation
    $result = $client->__soapCall("VerifyEmail", array($params), null, null, $output_header);

    //show status info
    output_status_info($result->VerifyEmailResult->ServiceStatus, $myEmail);
}

function output_Result($svcResult) {
    echo '<table border="1">';
    echo '<tr><td>Reason Code:</td><td>' . $svcResult->Reason->Code . '</td></tr>';
    echo '<tr><td>Reason Description:</td><td>' . $svcResult->Reason->Description . '</td></tr>';
    echo '<tr><td>Email:</td><td>' . $svcResult->Email . '</td></tr>';
    echo '<tr><td>Local Part:</td><td>' . $svcResult->LocalPart . '</td></tr>';
    echo '<tr><td>Domain Part:</td><td>' . $svcResult->DomainPart . '</td></tr>';
    echo '<tr><td>SourceIdentifier:</td><td>' . $svcResult->SourceIdentifier . '</td></tr>';
    echo '<tr><td>Iron Standard Certified Timestamp:</td><td>' . $svcResult->IronStandardCertifiedTimestamp . '</td></tr>';
    echo '</table>';
}

function output_DomainKnowledge($svcResult) {
    if (is_array($svcResult)) {
        echo '<table border="1">';
        foreach ($svcResult as $DK) {
            echo '<tr><td>' . $DK->Key . '</td><td>' . $DK->Value . '</td></tr>';
        }
        echo '</table><br /><br />';
    } else {
        echo '<table border="1">';
        echo '<tr><td>' . $DK->Key . '</td><td>' . $DK->Value . '</td></tr>';
        echo '</table><br /><br />';
    }
}

function output_AddressKnowledge($svcResult) {
    if (is_array($svcResult)) {
        echo '<table border="1">';
        foreach ($svcResult as $DK) {
            echo '<tr><td>' . $DK->Key . '</td><td>' . $DK->Value . '</td></tr>';
        }
        echo '</table><br /><br />';
    } else {
        echo '<table border="1">';
        echo '<tr><td>' . $DK->Key . '</td><td>' . $DK->Value . '</td></tr>';
        echo '</table><br /><br />';
    }
}

function output_status_info($status_info, $myEmail) {
    $myStatus = $status_info->StatusDescription;
    $myStatus = str_replace("Email", "", $myStatus);
    $myStatus = str_replace(" ", "", $myStatus);
    $myStatus = strtolower($myStatus);
    if ($myStatus == 'valid') {//valid
        echo "<mensaje>The account is valid (details: known user)</mensaje>";
    } elseif ($myStatus == 'notvalid') {//notvalid
        echo "<mensaje>The account is invalid (details: unknow user)</mensaje>";
    }
}

function output_subscription_info($subscription_info) {
    echo '<table border="1">';
    echo '<tr><td>License Status</td><td>' . $subscription_info->LicenseStatus . '</td></tr>';
    echo '<tr><td>License Action</td><td>' . $subscription_info->LicenseAction . '</td></tr>';
    echo '<tr><td>Remaining Hits</td><td>' . $subscription_info->RemainingHits . '</td></tr>';
    echo '</table>';
}
?>
