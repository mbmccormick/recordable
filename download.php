<?php

    $con = mysql_connect("data.mccormicktechnologies.com", "mccormick_tech", "mcc0rm1ck_t3ch!");
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db("mccormicktech_rec", $con);
    
    $result = mysql_query("SELECT * FROM recordable WHERE sessioncode = '$_GET[session]'");
    
    $row = mysql_fetch_array($result);

    if ($row[sessioncode] != null || $_GET[session] != null)
    {
        header("Content-disposition: attachment; filename=session$row[sessioncode].mp3");
        header("Content-type: audio/mp3");
        readfile("$row[recordingurl]");
    }
    else
    {
        header("Location: http://recordableapp.com/?error=We were unable to locate a recording for that session code. Please check your entry and try again.");
        exit;
    }

?>