<?php
    
    require "twilio.php";
    require "../config/config.php";
    
    $con = mysql_connect($Server, $Username, $Password);
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db($Database, $con);
    
    $sessionid = rand(100000, 999999);
    $code = $sessionid;
    
    $now = date("Y-m-d H:i:s");
    $nowlcl = date("Y-m-d H:i:s", strtotime("+3 hour", strtotime($now)));
        
    $sql = "INSERT INTO recordable (callsid, sessioncode, caller, called, recordingurl, duration, ispaid, createddate) VALUES
                ('$_POST[CallSid]', '$sessionid', '$_POST[Caller]', '+1$_GET[dialed]', '$_POST[RecordingUrl]', '$_POST[DialCallDuration]', '0', '" . $nowlcl . "')";
    if (!mysql_query($sql,$con))
    {
        die('Error: ' . mysql_error());
    }
    
    $sessionid = substr($sessionid, 0, 1) . ", " . substr($sessionid, 1, 1) . ", " . substr($sessionid, 2, 1) . ", " . substr($sessionid, 3, 1) . ", " . substr($sessionid, 4, 1) . ", " . substr($sessionid, 5, 1);
    
    echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
    echo "<Response>\n";
    echo "<Say voice='man'>Thank you, your call is now complete. The session code for this call is $sessionid. Once again, the session code for this call is $sessionid. A text message with this code has been sent to your phone. Goodbye!</Say>\n";
    echo "</Response>\n";
    
    $client = new TwilioRestClient($AccountSid, $AuthToken);

    $response = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages", 
        "POST", array(
        "To" => $_POST[Caller],
        "From" => $PhoneNumber,
        "Body" => "Thank you for using Recordable! The session code for your call is $code. Enter this code at http://recordableapp.com to listen to your recording."
    ));

    mysql_close($con);

?>