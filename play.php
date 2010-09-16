<?php

    $con = mysql_connect("data.mccormicktechnologies.com", "mccormick_tech", "mcc0rm1ck_t3ch");
    if (!$con)
    {
        die("Could not connect: " . mysql_error());
    }

    mysql_select_db("mccormicktech_rec", $con);
    
    $result = mysql_query("SELECT * FROM recordable WHERE sessioncode = '$_GET[sessioncode]'");
    
    $row = mysql_fetch_array($result);

    if ($row[sessioncode] == null)
    {
        header("Location: http://recordableapp.com/error.php");
        exit;
    }
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="html"> 
<head>
  <title>Recordable - Simple phone conversation recording, anywhere, anytime!</title>
  <script type="text/javascript" src="files/css-browser-selector.js"></script>
  <link rel="stylesheet" href="files/stylesheet.css" />
  <link rel="shortcut icon" type="image/x-icon" href="/files/favicon.ico">
</head>
<body>
  <table cellspacing="0" style="width: 100%">
    <tr>
      <td>
        <script type="text/javascript"><!--
            google_ad_client = "pub-3252379636480495";
            /* 120x240, created 9/15/10 */
            google_ad_slot = "1677549466";
            google_ad_width = 120;
            google_ad_height = 240;
            //-->
            </script>
            <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
      </td>
      <td>
        &nbsp;
      </td>
      <td style="width: 600px;" align="center">
          <table style="width: 100%;" align="left">
            <tr height="60">
                <td align="left" valign="middle" style="padding-top: 10px; cursor: pointer; color: #00D644;" onclick="location.href='http://recordableapp.com/';">
                    <span style="font-size: 48px; font-family: Hand of Sean;">Recordable</span>
                </td>
                <td align="right" valign="middle">
                    <span style="font-size: 32px; font-weight: bold; color: red;">877-395-3442</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Simple phone conversation recording, anywhere, anytime!
                </td>
            </tr>
            <tr height="153">
                <td colspan="2">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="middle">
                    <form action="play.php" method="get">
                        <span style="color: #00D644; font-size: 28px;">Enter your session code: </span>
                        <input name="sessioncode" style="font-size: 28px; border: solid 1px #CCCCCC; width: 102px; text-align: center; font-family: Myriad Pro;" type="text" value="<?php echo $row[sessioncode]; ?>" />
                        <input onclick="this.form.action='play.php'; return true;" type="submit" class="input-submit" value="Play" />
                        <input onclick="this.form.action='download.php'; return true;" type="submit" class="input-submit" value="Download" />
                    </form>
                    <embed src="<?php echo $row[recordingurl]; ?>" autostart="true" loop="false" hidden="true"></embed>
                </td>
            </tr>
          </table>
      </td>
      <td>
        &nbsp;
      </td>
      <td align="right">
        <script type="text/javascript"><!--
            google_ad_client = "pub-3252379636480495";
            /* 120x240, created 9/15/10 */
            google_ad_slot = "1677549466";
            google_ad_width = 120;
            google_ad_height = 240;
            //-->
            </script>
            <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
      </td>
    </tr>
    <tr>
      <td colspan="5" valign="bottom" style="height: 185px;">
        <center>Copyright &copy; 2010 <a href="http://mccormicktechnologies.com/" style="text-decoration: none;" target="_blank">McCormick Technologies LLC</a>. All rights reserved.</center>
      </td>
    </tr>
  </table>
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