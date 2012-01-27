<?php

    function common_home()
    {
        set("title", "Home");
        return html("common/home.php");
    }

    function common_play()
    {
        $result = mysql_query("SELECT * FROM recordable WHERE sessioncode='" . $_GET[code] . "'");  
        $conversation = mysql_fetch_array($result);

        if ($conversation != null)
        {
            $caller = str_replace("+1", "", $conversation[caller]);
            $caller = substr($caller, 0, 3) . "-" . substr($caller, 3, 3) . "-" . substr($caller, 6, 4);

            $called = str_replace("+1", "", $conversation[called]);
            $called = substr($called, 0, 3) . "-" . substr($called, 3, 3) . "-" . substr($called, 6, 4);

            set("conversation", $conversation);
            set("caller", $caller);
            set("called", $called);

            if ($conversation[ispaid] == 1)
            {
                set("title", "Play");
                return html("common/play.php");  
            } 
            else
            {
                set("title", "Purchase");
                return html("common/purchase.php");
            }         
        }
        else
        {
            header("Location: " . option('base_uri') . "&error=We were unable to locate a recording for that session code!");
            exit;
        }
    }

    function common_play_2()
    {
        $result = mysql_query("SELECT * FROM recordable WHERE sessioncode='" . params('session') . "'");  
        $conversation = mysql_fetch_array($result);

        if ($conversation != null)
        {
            $caller = str_replace("+1", "", $conversation[caller]);
            $caller = substr($caller, 0, 3) . "-" . substr($caller, 3, 3) . "-" . substr($caller, 6, 4);

            $called = str_replace("+1", "", $conversation[called]);
            $called = substr($called, 0, 3) . "-" . substr($called, 3, 3) . "-" . substr($called, 6, 4);

            set("conversation", $conversation);
            set("caller", $caller);
            set("called", $called);

            if ($conversation[ispaid] == 1)
            {
                set("title", "Play");
                return html("common/play.php");  
            } 
            else
            {
                set("title", "Purchase");
                return html("common/purchase.php");
            }         
        }
        else
        {
            header("Location: " . option('base_uri') . "&error=We were unable to locate a recording for that session code!");
            exit;
        }
    }

    function common_download()
    {
        $result = mysql_query("SELECT * FROM recordable WHERE sessioncode='" . params('session') . "'");  
        $row = mysql_fetch_array($result);

        if ($row != null)
        {
            if ($row[ispaid] == 0)
            {
                header("Location: " . option('base_uri') . "play/" . $row[sessioncode]);
                exit;
            }
            
            header("Content-disposition: attachment; filename=session" . $row[sessioncode] . ".mp3");
            header("Content-type: audio/mpeg");
            readfile($row[recordingurl]);
        }
        else
        {
            header("Location: " . option('base_uri') . "&error=We were unable to locate a recording for that session code!");
            exit;
        }
    }

    function common_payment()
    {
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

        mysql_query("UPDATE recordable SET notes='" . implode(",", $_POST) . "' WHERE sessioncode='" . params('session') . "'"); 

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
                    $result = mysql_query("SELECT * FROM recordable WHERE sessioncode='" . params('session') . "'");                
                    $row = mysql_fetch_array($result);
                    
                    if ($payment_status == "Completed")
                    {
                        if ($payment_amount == (0.35 + (ceil($row[duration] / 60) * 0.10)) &&
                            $payment_currency == "USD")
                        {
                            mysql_query("UPDATE recordable SET ispaid='1' WHERE sessioncode='" . params('session') . "'"); 
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
    }

?>