<?php

	echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
    echo "<Response>\n";
    echo "<Gather action='/call/record.php?number=$_POST[Digits]' method='POST' numDigits='1'>\n";
    echo "<Say voice='man'>Federal and State Laws require consent of both parties in order to record this call. To play an automated message to your party when they answer, press one. Otherwise, to do it yourself, please stay on the line.</Say>\n";
    echo "</Gather>\n";
    echo "</Response>\n";

?>