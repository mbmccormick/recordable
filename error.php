<html>
<head>
  <title>Recordable</title>
  <script type="text/javascript">
    function delayedRedirect(){
      history.go(-1);
    }
  </script>
  <style>
  body
    {
	    font-family: "Myriad Pro" , Trebuchet MS;
	    font-size: 16px;
	    line-height: 1.0em;
    }
    
    @font-face
    {
	    font-family: "Myriad Pro";
	    src: url("/files/MyriadPro-Regular.otf");
    }

    @font-face
    {
	    font-family: "Myriad Pro";
	    font-weight: bold;
	    src: url("/files/MyriadPro-Bold.otf");
    }
  </style>
</head>
<body style="padding: 50px; width: 800px; text-align: center; margin: 0px auto;" onLoad="setTimeout('delayedRedirect()', 3000)">
  <span style='padding: 3px; font-size: 15px; background-color: red; color: #ffffff; font-weight: bold;'>
    <?php
        
        echo "Hmm, we couldn't find the session for that code. Please check your input and try again!";
        
    ?>
  </span>
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-6872595-7']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

  </script>
</body>
</html>