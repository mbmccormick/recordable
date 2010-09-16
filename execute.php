<?php

    require "twilio.php";

    $con = mysql_connect("data.mccormicktechnologies.com", "mccormick_tech", "mcc0rm1ck_t3ch");
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db("mccormicktech_rem", $con);
    
    $result = mysql_query("SELECT * FROM remindable LIMIT 10");
    
    while($row = mysql_fetch_array($result))
    {
        $diff = 8 - (int)$row['timezone'];
        
        $now = date("Y-m-d H:i:s");
        $nowlcl = date("Y-m-d H:i:s", strtotime("+" . $diff . " hour", strtotime($now)));
        
        echo $row['duedate'] . " <= " . $nowlcl . "<br />";
        
        if ($row['duedate'] <= $nowlcl)
        {
            $ApiVersion = "2008-08-01";
            $AccountSid = "AC5057e5ab36685604eecc9b1fdd8528e2";
            $AuthToken = "309e6930d27b624bbfaa45dac382c6ae";
            
            if ($row['destinationtype'] == 1)
            {
                // call
                $client = new TwilioRestClient($AccountSid, $AuthToken);

                $response = $client->request("/$ApiVersion/Accounts/$AccountSid/Calls",
                    "POST", array(
                    "Caller" => "505-609-8968",
                    "Called" => $row['destination'],
                    "Url" => "http://remindableapp.com/call.php?id=" . $row['id']
                ));
                
                if($response->IsError)
                {
                    $err = $response->ErrorMessage;
                    echo $err;
                    die;
                }
            }
            elseif ($row['destinationtype'] == 2)
            {
                // email
                $to = $row['destination'];
                $subject = "Your Remindable has arrived!";
                $message = stripslashes($row['text']) . "\n\n--\nRemindable\nhttp://remindableapp.com";
                $from = "Remindable <robot@remindableapp.com>";
                
                mail($to, $subject, $message, "From: " . $from);
                
                mysql_query("DELETE FROM remindable WHERE id = '" . $row['id'] . "'");
            }
            elseif ($row['destinationtype'] == 3)
            {
                // sms
                $client = new TwilioRestClient($AccountSid, $AuthToken);

                $response = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages", 
                    "POST", array(
                    "To" => $row['destination'],
                    "From" => "505-609-8968",
                    "Body" => "Remindable: " . stripslashes($row['text'])
                ));
                
                mysql_query("DELETE FROM remindable WHERE id = '" . $row['id'] . "'");
            }
        }
    }

    mysql_close($con);

?>