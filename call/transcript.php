<?php
    
    $con = mysql_connect("data.mccormicktechnologies.com", "mccormick_tech", "mcc0rm1ck_t3ch!");
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db("mccormicktech_rec", $con);
    
    $sql = "UPDATE recordable SET transcripturl='" . $_POST[TranscriptionUrl] . "' WHERE callsid='" . $_POST[CallSid] . "'";
    
    if (!mysql_query($sql,$con))
    {
        die('Error: ' . mysql_error());
    }

    mysql_close($con);

?>