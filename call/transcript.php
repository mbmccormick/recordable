<?php
    
    require "../config/config.php";
    
    $con = mysql_connect($Server, $Username, $Password);
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db($Database, $con);
    
    $sql = "UPDATE recordable SET transcripturl='" . $_POST[TranscriptionUrl] . "' WHERE callsid='" . $_POST[CallSid] . "'";
    if (!mysql_query($sql,$con))
    {
        die('Error: ' . mysql_error());
    }

    mysql_close($con);

?>