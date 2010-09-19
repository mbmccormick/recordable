<?php

    $con = mysql_connect("data.mccormicktechnologies.com", "mccormick_tech", "mcc0rm1ck_t3ch!");
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db("mccormicktech_rec", $con);
    
    $result = mysql_query("SELECT * FROM recordable WHERE sessioncode = '$_GET[sessioncode]'");
    
    $row = mysql_fetch_array($result);

    if ($row[sessioncode] != null)
    {
        header("Content-disposition: attachment; filename=session$row[sessioncode].wav");
        header("Content-type: audio/wav");
        readfile("$row[recordingurl]");
    }
    else
    {
        header("Location: http://recordableapp.com/error.php");
        exit;
    }

?>