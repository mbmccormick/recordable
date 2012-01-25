<?php

    echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
    echo "<Response>\n";
    echo "<Gather action='/call/prompt.php' method='POST' numDigits='1' timeout='15'>\n";
    echo "<Say voice='man'>Hello, and welcome to Recordable! To place a call, press one. To listen to a previous recording, press two.</Say>\n";
    echo "</Gather>\n";
    echo "</Response>\n";

?>