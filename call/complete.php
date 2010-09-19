<?php

    $con = mysql_connect("data.mccormicktechnologies.com", "mccormick_tech", "mcc0rm1ck_t3ch!");
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db("mccormicktech_rec", $con);
    
    $sessionid = rand(10000, 99999);
    
    $now = date("Y-m-d H:i:s");
    $nowlcl = date("Y-m-d H:i:s", strtotime("+3 hour", strtotime($now)));
        
    $sql = "INSERT INTO recordable (callsid, sessioncode, party1, party2, recordingurl, createddate) VALUES
                ('$_POST[CallSid]', '$sessionid', '$_POST[Caller]', '$_POST[Digits]', '$_POST[RecordingUrl]', '" . $nowlcl . "')";
    
    if (!mysql_query($sql,$con))
    {
        die('Error: ' . mysql_error());
    }
    
    $sessionid = substr($sessionid, 0, 1) . " " . substr($sessionid, 1, 1) . " " . substr($sessionid, 2, 1) . " " . substr($sessionid, 3, 1) . " " . substr($sessionid, 4, 1);
    
    echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
    echo "<Response>\n";
    echo "<Say voice='man'>Thank you, your call is now complete. The session code for this call is $sessionid. Once again, the session code for this call is $sessionid. Goodbye!</Say>\n";
    echo "</Response>\n";

    mysql_close($con);

?>