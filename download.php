<?php

    $con = mysql_connect($Server, $Username, $Password);
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db($Database, $con);
    
    $result = mysql_query("SELECT * FROM recordable WHERE sessioncode = '$_GET[session]'");
    
    $row = mysql_fetch_array($result);

    if ($row[sessioncode] != null || $_GET[session] != null)
    {
        header("Content-disposition: attachment; filename=session$row[sessioncode].mp3");
        header("Content-type: audio/mpeg");
        readfile("$row[recordingurl]");
    }
    else
    {
        header("Location: http://recordableapp.com/?error=We were unable to locate a recording for that session code. Please check your entry and try again.");
        exit;
    }

?>