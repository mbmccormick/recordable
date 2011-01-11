<?php

    require "call/twilio.php";

    if (isset($_GET[session]) == true)
    {
        $con = mysql_connect($Server, $Username, $Password);
        if (!$con)
        {
            die("Could not connect: " . mysql_error());
        }

        mysql_select_db($Database, $con);
        
        $result = mysql_query("SELECT * FROM recordable WHERE sessioncode = '$_GET[session]'");
        
        $row = mysql_fetch_array($result);
        
        if ($row[sessioncode] == null || $_GET[session] == null)
        {
            header("Location: http://recordableapp.com/?error=We were unable to locate a recording for that session code. Please check your entry and try again.");
            exit;
        }
        else
        {
            if ($row[transcripturl] != null)
            {
                $client = new TwilioRestClient($AccountSid, $AuthToken);
                $response = $client->request(str_replace("http://api.twilio.com", "", $row[transcripturl]), "GET");
                
                $text = $response->ResponseXml->Transcription->TranscriptionText;
            }
        }
    }
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="html"> 
<head>
    <title>Recordable - Simple phone conversation recording.</title>
    <meta name="description" content="Simple phone conversation recording." />
    <link rel="stylesheet" href="/files/stylesheet.css" />
    <link rel="shortcut icon" type="image/x-icon" href="/files/favicon.ico"> 
    <script type="text/javascript" src="/files/css-browser-selector.js"></script>
    <script type="text/javascript" src="/files/jquery.js"></script>
    <script type="text/javascript" src="/files/jquery.showmessage.js"></script>
    <script type="text/javascript" src="/files/common.js"></script>
    <script type="text/javascript" src="/files/audio-player.js"></script>  
    <script type="text/javascript">
        AudioPlayer.setup("http://recordableapp.com/files/player.swf", {
            width: 357,
            autostart: "yes",
            animation: "no"
        });
    </script>
</head>
<body>
    <div class="page">
        <div class="header">
            <table cellpadding="0" cellspacing="0" style="width: 100%;">
                <tr valign="middle">
                    <td align="left">
                        <h1><a href="/"><img src="/files/logo.png" /></a></h1>
                        <p>Simple phone conversation recording.</p>
                    </td>
                    <td align="right">
                        <div class="highlight">
                            877-395-3442
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="content">
            <div class="step">
                <span class="step-number">1.&nbsp;</span>&nbsp;Dial <b>877-395-3442</b> from your phone.
            </div>
            <div class="step">
                <span class="step-number">2.&nbsp;</span>&nbsp;Follow the prompts and place your call.
            </div>
            <div class="step">
                <span class="step-number">3.&nbsp;</span>&nbsp;Receive your session code and enter it below.
            </div>
            <div class="form">
                <form action="/" method="get">
                    Enter your session code here: 
                    <input name="session" type="text" size="7" value="<?php echo $row[sessioncode]; ?>" />
                    <input onclick="this.form.action='/'; return true;" type="submit" value="Play" />
                    <input onclick="this.form.action='/download.php'; return true;" type="submit" value="Download" />
                </form>
                <?php if ($row[sessioncode] != null || $_GET[session] != null) { ?>
                <br />
                <p id="audioplayer_1">Sorry, your browser does not support Adobe Flash!</p>  
                <script type="text/javascript">
                    AudioPlayer.embed("audioplayer_1", {soundFile: "<?php echo $row[recordingurl]; ?>.mp3", titles: "Session #<?php echo $row[sessioncode]; ?>"});
                </script>
                <?php if ($text != null) { ?>
                <div class="transcript">
                <b>Transcription:</b>
                <?php echo $text; ?>
                </div>
                <?php } else { ?>
                <div class="transcript">
                <b>Transcription:</b>
                <i>Your transcription is not ready yet, please check back later...</i>
                </div>
                <?php } ?>
                <?php } ?>                
            </div>
            <div class="question-list">
                <div class="question">
                    <h3>How much does this service cost?</h3>
                    For now, nothing. Recordable is still in the early stages of development. As we add more features and really start to harden our services, we may switch to a payment plan. But rest assured, basic phone conversation recording will always be free!
                </div>
                <div class="question">
                    <h3>Where are my recordings stored?</h3>
                    Your recordings are stored on <a href="http://www.twilio.com/" target="_blank">Twilio</a>'s secure servers forever. They are not stored on our server, so you don't have to worry about security when it comes to your conversation recordings. Not only does this help ensure maximum security, it also helps to deliver your recordings to you from anywhere in the world as fast as possible.
                </div>
                <div class="question">
                    <h3>What happens if I forget my session code?</h3>
                    In order to ensure maximum security for our users, if you forget your session code, we cannot retrieve your recording for you. Because the session code is so important, you will receive a text message after you phone call is complete with your session code to make it easier to remember.
                </div>
                <div class="question">
                    <h3>Is it legal to record my phone calls?</h3>
                    Federal and State Laws regarding phone call recording vary by state. Users are responsible for informing their party that a call is recorded if their state requires this. Recordable does not take responsibility for it's users' decision of whether or not to comply with these regulations. More information can be found on <a href="http://en.wikipedia.org/wiki/Telephone_recording_laws" target="_blank">Wikipedia</a>.
                </div>
                <div class="question">
                    <h3>Can I make international calls?</h3>
                    Unfortunately, we do not support international calls at this time. We do have plans to allow international calls in the future, but at this point in the development phase we do not support it. If this feature is something that interests you, please let us know!
                </div>
            </div>
        </div>
        <div class="footer">
            <table cellpadding="0" cellspacing="0" style="width: 100%;">
                <tr valign="middle">
                    <td align="left">
                        Copyright &copy; 2010 <a href="http://mccormicktechnologies.com/" style="text-decoration: none;" target="_blank">McCormick Technologies LLC</a>. All rights reserved.
                    </td>
                    <td align="right">
                        <img src="/files/twilio.png" />
                    </td>
                </tr>
            </table>
        </div>
        <div id="arrow-top" style="display: none; ">
            &#9650;
        </div>
    </div>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-6872595-10']);
        _gaq.push(['_trackPageview']);
        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <script type="text/javascript" charset="utf-8">
        var is_ssl = ("https:" == document.location.protocol);
        var asset_host = is_ssl ? "https://s3.amazonaws.com/getsatisfaction.com/" : "http://s3.amazonaws.com/getsatisfaction.com/";
        document.write(unescape("%3Cscript src='" + asset_host + "javascripts/feedback-v2.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript" charset="utf-8">
        var feedback_widget_options = {};
        feedback_widget_options.display = "overlay";  
        feedback_widget_options.company = "recordable";
        feedback_widget_options.placement = "right";
        feedback_widget_options.color = "#222";
        feedback_widget_options.style = "problem";  
        var feedback_widget = new GSFN.feedback_widget(feedback_widget_options);
    </script>
</body>
</html>