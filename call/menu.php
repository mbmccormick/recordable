<?php

    echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
    echo "<Response>\n";
    echo "<Gather action='/call/disclaimer.php' method='POST' numDigits='10'>\n";
    echo "<Say voice='man'>Hello, and welcome to Recordable! Please enter the 10 digit phone number that you would like to dial.</Say>\n";
    echo "</Gather>\n";
    echo "</Response>\n";

?>