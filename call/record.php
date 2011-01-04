<?php

	echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
    echo "<Response>\n";
    echo "<Say voice='man'>You will now be connected with your party, press star when you have finished your conversation.</Say>\n";
    echo "<Dial action='/call/complete.php?dialed=$_POST[Digits]' hangupOnStar='true' record='true' transcribe='true' transcribeCallback='/call/transcript.php' maxLength='5400' callerId='$_POST[Caller]'>\n";
    echo "$_POST[Digits]\n";
    echo "</Dial>\n";
    echo "</Response>\n";

?>