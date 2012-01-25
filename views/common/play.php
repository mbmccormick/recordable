<div class="row">
    <div class="span8">
        <?php if ($conversation[ispaid] == 1) { ?>
        <p id="audioplayer">Sorry, your browser does not support Adobe Flash!</p>  
        <script type="text/javascript">
            AudioPlayer.embed("audioplayer", {soundFile: "<?=$conversation[recordingurl]?>.mp3", titles: "Session #<?php echo $row[sessioncode]; ?>"});
        </script>
        <?php } else { ?>
        <p style="font-size: 16px; font-weight: normal; line-height: 1.5em;">To access your recording online, please click the button below. The total for your recording is <b>$<?=(0.35 + (ceil($conversation[duration] / 60) * 0.10))?></b>, this is a one-time fee and offers unlimited access to your recording.</p>
        <br />
        <form method="post" name="form" action="https://www.paypal.com/cgi-bin/webscr"> 
            <input type="hidden" name="notify_url" value="http://<?=$_SERVER['HTTP_HOST']?>/payment" /> 
            <input type="hidden" name="cmd" value="_ext-enter" /> 
            <input type="hidden" name="redirect_cmd" value="_xclick" /> 
            <input type="hidden" name="business" value="paypal@mccormicktechnologies.com" /> 
            <input type="hidden" name="item_name" value="Recordable (Session #<?=$conversation[sessioncode]?>)" /> 
            <input type="hidden" name="item_number" value="<?=$conversation[sessioncode]?>" /> 
            <input type="hidden" name="amount" value="<?=(0.35 + (ceil($conversation[duration] / 60) * 0.10))?>" /> 
            <input type="hidden" name="no_shipping" value="1" /> 
            <input type="hidden" name="currency_code" value="USD" /> 
            <input type="hidden" name="return" value="http://<?=$_SERVER['HTTP_HOST']?>/play/<?=$conversation[sessioncode]; ?>" />
            <input type="submit" value="Access Recording" style="background-color: #71B520; font-size: 20px; font-weight: bold;" />
        </form>
        <?php } ?>
    </div>
</div>