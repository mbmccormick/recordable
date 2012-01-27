<?php

    function inbound_voice_menu()
    {
        echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
        echo "<Response>\n";
        echo "<Gather action='" . option('base_uri') . "inbound/voice/prompt' method='POST' numDigits='1' timeout='15'>\n";
        echo "<Say voice='man'>Hello, and welcome to Recordable! To place a call, press one. To listen to a previous recording, press two.</Say>\n";
        echo "</Gather>\n";
        echo "</Response>\n";
    }

    function inbound_voice_prompt()
    {
        if ($_POST[Digits] == "1")
        {
            echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
            echo "<Response>\n";
            echo "<Gather action='" . option('base_uri') . "inbound/voice/record' method='POST' numDigits='10' timeout='15'>\n";
            echo "<Say voice='man'>Please enter the ten digit phone number that you would like to dial.</Say>\n";
            echo "</Gather>\n";
            echo "</Response>\n";
        }
        else if ($_POST[Digits] == "2")
        {
            echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
            echo "<Response>\n";
            echo "<Gather action='" . option('base_uri') . "inbound/voice/play' method='POST' numDigits='6' timeout='15'>\n";
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
    }

    function inbound_voice_record()
    {
        echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
        echo "<Response>\n";
        echo "<Say voice='man'>You will now be connected with your party, press star when you have finished your conversation.</Say>\n";
        // echo "<Dial action='" . option('base_uri') . "inbound/voice/complete?dialed=" . $_POST[Digits] . "' hangupOnStar='true' record='true' transcribe='true' transcribeCallback='" . option('base_uri') . "inbound/voice/transcript' maxLength='5400' callerId='" . $_POST[Caller] . "'>\n";
        echo "<Dial action='" . option('base_uri') . "inbound/voice/complete?dialed=" . $_POST[Digits] . "' hangupOnStar='true' record='true' callerId='" . $_POST[Caller] . "'>\n";
        echo $_POST[Digits] . "\n";
        echo "</Dial>\n";
        echo "</Response>\n";
    }

    function inbound_voice_complete()
    {
        $code = rand(100000, 999999);
        $friendly = substr($code, 0, 1) . ", " . substr($code, 1, 1) . ", " . substr($code, 2, 1) . ", " . substr($code, 3, 1) . ", " . substr($code, 4, 1) . ", " . substr($code, 5, 1);
        
        $now = date("Y-m-d H:i:s");
            
        $sql = "INSERT INTO recordable (callsid, sessioncode, caller, called, recordingurl, duration, ispaid, createddate) VALUES ('" . $_POST[CallSid] . "', '" . $code . "', '" . $_POST[Caller] . "', '+1" . $_GET[dialed] . "', '" . $_POST[RecordingUrl] . "', '" . $_POST[DialCallDuration] . "', '0', '" . $now . "')";
        mysql_query($sql);
        
        echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
        echo "<Response>\n";
        echo "<Say voice='man'>Thank you, your call is now complete. The session code for this call is " . $friendly . ". Once again, the session code for this call is " . $sessionid . ". A text message with this code has been sent to your phone. Goodbye!</Say>\n";
        echo "</Response>\n";
        
        $twilio = new Services_Twilio('AC5057e5ab36685604eecc9b1fdd8528e2', '309e6930d27b624bbfaa45dac382c6ae');

        $message = $twilio->account->sms_messages->create(
            "313-528-6816",
            $_POST[Caller],
            "Thank you for using Recordable! The session code for your call is " . $code . ". Enter this code at http://recordableapp.com to listen to your recording."
        );
    }

    function inbound_voice_play()
    {
        $result = mysql_query("SELECT * FROM recordable WHERE sessioncode='" . $_POST[Digits] . "'");
        $row = mysql_fetch_array($result);

        if ($row[sessioncode] != null)
        {
            echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
            echo "<Response>\n";
            echo "<Say>Please wait while we retrieve your recording.</Say>\n";
            echo "<Play>" . $row[recordingurl] . ".mp3</Play>\n";
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
    }

    function inbound_voice_transcript()
    {
    	$result = mysql_query("UPDATE recordable SET transcripturl='" . $_POST[TranscriptionUrl] . "' WHERE callsid='" . $_POST[CallSid] . "'");
    }

?>