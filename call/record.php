<?php

	echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
    echo "<Response>\n";
    echo "<Say voice='man'>You will now be connected with your party, press star when you have finished your conversation.</Say>\n";
    echo "<Dial action='/call/complete.php' hangupOnStar='true' record='true' callerId='$_POST[Caller]'>\n";    
    if ($_POST[Digits] == "1")
    {
        echo "<Number url='/call/answer.php'>\n";
    }
    else
    {
        echo "<Number>\n";
    }
    echo "$_GET[number]\n";
    echo "</Number>\n";
    echo "</Dial>\n";
    echo "</Response>\n";

?>