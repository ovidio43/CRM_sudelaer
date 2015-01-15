<?php
/*
 * StrikeIron Email Verification v6.0.0
 * http://www.strikeiron.com/product-list/email/email-verification/
 *
 * Required:
 *
 *  1. PHP 5 with soap extensions
 *  2. A registered StrikeIron account with a userid/password.
 *		To register please visit: http://www.strikeiron.com/Register.aspx
 * 		Then set the $USER_ID and $PASSWORD below
 *
 * To run this script, copy it to a directory on your web server and access with a browser.
 *
 *
 * For additional support:
 *  email: support@strikeiron.com
 *  phone: +1 919-467-4545 opt. 3
 *
 *
 */

$USER_ID = "knt_277@hotmail.es"; //replace this value with your StrikeIron UserID or Email Verification v6.0.0 License Key 
$PASSWORD = "xPReTV"; //Replace this value with your StrikeIron Web Service Password; you can set this value to null if you are using a License Key

$WSDL = 'http://ws.strikeiron.com/EmailVerify6?WSDL';

// create client
$client = new SoapClient($WSDL, array('trace' => 1, 'exceptions' => 1));

// create registered user for soap header
$registered_user = array("RegisteredUser" => array("UserID" => $USER_ID,"Password" => $PASSWORD));
$header = new SoapHeader("http://ws.strikeiron.com", "LicenseInfo", $registered_user);

// set soap headers - this will apply to all operations
$client->__setSoapHeaders($header);

try
{
  //Calls VerifyEmail and displayes the result
  VerifyEmail();
}
catch (Exception $ex)
{
	echo $ex->getMessage() . "<br />";
}

function VerifyEmail()
{
  global $client;

  //Set up input parameters for the VerifyEmail operation
  $emailAddress = 'daasdfasdq332sad@gmail.com';
  $timeout = '30';

  //set up parameter array
  $params = array("Email" => $emailAddress,
  	          "Timeout" => $timeout,
            );

  //call the web service operation
  $result = $client->__soapCall("VerifyEmail", array($params), null, null, $output_header);

  //show service results
  //Note that these are not all the fields contained in the service
  echo "<h1>VerifyEmail Result:</h1><br />";
  output_Result($result->VerifyEmailResult->ServiceResult);
  output_DomainKnowledge($result->VerifyEmailResult->ServiceResult->DomainKnowledge->StringKeyValuePair);
  output_AddressKnowledge($result->VerifyEmailResult->ServiceResult->AddressKnowledge->StringKeyValuePair);

  //show status info
  echo "<br /><h2>Status Info:</h2><br />";
  output_status_info($result->VerifyEmailResult->ServiceStatus);

  //show subscription info
  echo "<br /><h2>Subscription Info:</h2><br />";
  output_subscription_info($output_header['SubscriptionInfo']);
}


function output_Result( $svcResult )
{
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

function output_DomainKnowledge( $svcResult )
{
    echo '<b>Domain Knowledge</b><br />';
if(is_array($svcResult)){
 echo '<table border="1">'; 
 foreach ($svcResult as $DK) 
  {
     echo '<tr><td>' . $DK->Key . '</td><td>' . $DK->Value . '</td></tr>';
  }
   echo '</table><br /><br />';
}
else{ 
    echo '<table border="1">';
         echo '<tr><td>' . $DK->Key . '</td><td>' . $DK->Value . '</td></tr>';
    echo '</table><br /><br />';
}
}
function output_AddressKnowledge( $svcResult )
{
    echo '<b>Address Knowledge</b><br />';
if(is_array($svcResult)){
 echo '<table border="1">'; 
 foreach ($svcResult as $DK) 
  {
     echo '<tr><td>' . $DK->Key . '</td><td>' . $DK->Value . '</td></tr>';
  }
   echo '</table><br /><br />';
}
else{ 
    echo '<table border="1">';
         echo '<tr><td>' . $DK->Key . '</td><td>' . $DK->Value . '</td></tr>';
    echo '</table><br /><br />';
}
}

function output_status_info( $status_info )
{
	echo '<table border="1">';
		echo '<tr><td>Status Description</td><td>' . $status_info->StatusDescription . '</td></tr>';
		echo '<tr><td>Status Nbr</td><td>' . $status_info->StatusNbr . '</td></tr>';
	echo '</table>';
}

function output_subscription_info( $subscription_info )
{
	echo '<table border="1">';
		echo '<tr><td>License Status</td><td>' . $subscription_info->LicenseStatus . '</td></tr>';
		echo '<tr><td>License Action</td><td>' . $subscription_info->LicenseAction . '</td></tr>';
		echo '<tr><td>Remaining Hits</td><td>' . $subscription_info->RemainingHits . '</td></tr>';
	echo '</table>';
}

?>
