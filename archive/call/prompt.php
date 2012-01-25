<?php

    if ($_POST[Digits] == "1")
    {
        echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
        echo "<Response>\n";
        echo "<Gather action='/call/record.php' method='POST' numDigits='10' timeout='15'>\n";
        echo "<Say voice='man'>Please enter the ten digit phone number that you would like to dial.</Say>\n";
        echo "</Gather>\n";
        echo "</Response>\n";
    }
    else if ($_POST[Digits] == "2")
    {
        echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
        echo "<Response>\n";
        echo "<Gather action='/call/play.php' method='POST' numDigits='6' timeout='15'>\n";
        echo "<Say voice='man'>Please enter the six digit session code for the recording you would like to hear.</Say>\n";
        echo "</Gather>\n";
        echo "</Response>\n";
    }
    else
    {
        echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
        echo "<Response>\n";
        echo "<Say voice='man'>We're sorry, but we couldn't understand your selection. Please try your call again later. Goodbye!</Say>\n";
        echo "</Response>\n";
    }
    
?>