<?php

    $con = mysql_connect("data.mccormicktechnologies.com", "mccormick_tech", "mcc0rm1ck_t3ch!");
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db("mccormicktech_rec", $con);
    
    $result = mysql_query("SELECT * FROM recordable WHERE sessioncode = '$_POST[Digits]'");
    
    $row = mysql_fetch_array($result);

    if ($row[sessioncode] != null)
    {
        echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
        echo "<Response>\n";
        echo "<Say>Please wait while we retrieve your recording.</Say>\n";
        echo "<Play>$row[recordingurl].mp3</Play>\n";
        echo "<Say>The playback for your recording is now complete. Goodbye!</Say>\n";
        echo "</Response>\n";
    }
    else
    {
        echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
        echo "<Response>\n";
        echo "<Say>We were unable to locate a recording for that session code. Please try your entry again. Goodbye!</Say>\n";
        echo "</Response>\n";
    }

?>