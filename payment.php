<?php

    require "config/config.php";
    
    $con = mysql_connect($Server, $Username, $Password);
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db($Database, $con);
                
    // read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-validate';

    foreach ($_POST as $key => $value)
    {
        $value = urlencode(stripslashes($value));
        $req .= "&$key=$value";
    }

    // post back to PayPal system to validate
    $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
    $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

    // assign posted variables to local variables
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];

    if (!$fp)
    {
        // HTTP ERROR
    }
    else
    {
        fputs ($fp, $header . $req);
        while (!feof($fp))
        {
            $res = fgets ($fp, 1024);
            if (strcmp ($res, "VERIFIED") == 0)
            {
                $result = mysql_query("SELECT * FROM recordable WHERE sessioncode='$item_number'");                
                $row = mysql_fetch_array($result);
                
                if ($payment_status == "Completed")
                {
                    if ($payment_amount == (0.35 + (ceil($row[duration] / 60) * 0.10)) &&
                        $payment_currency == "USD")
                    {
                        mysql_query("UPDATE recordable SET ispaid='1' WHERE sessioncode='$item_number'"); 
                    }
                }
            }
            else if (strcmp ($res, "INVALID") == 0)
            {
                // log for manual investigation
            }
        }
        fclose ($fp);
    }

?>