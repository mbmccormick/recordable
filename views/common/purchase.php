<div class="row">
    <div class="span15">
        <p>To purchase online access to this recording, click the link below. The total for this recording is <b>$<?=(0.35 + (ceil($conversation[duration] / 60) * 0.10))?></b>, a one-time payment that provides unlimited access to your recording.</p>
        <br />
        <form method="post" name="form" action="https://www.paypal.com/cgi-bin/webscr"> 
            <input type="hidden" name="notify_url" value="http://<?=$_SERVER['HTTP_HOST']?><?=option('base_uri')?>payment" /> 
            <input type="hidden" name="cmd" value="_ext-enter" /> 
            <input type="hidden" name="redirect_cmd" value="_xclick" /> 
            <input type="hidden" name="business" value="paypal@mccormicktechnologies.com" /> 
            <input type="hidden" name="item_name" value="Recordable (Session #<?=$conversation[sessioncode]?>)" /> 
            <input type="hidden" name="item_number" value="<?=$conversation[sessioncode]?>" /> 
            <input type="hidden" name="amount" value="<?=(0.35 + (ceil($conversation[duration] / 60) * 0.10))?>" /> 
            <input type="hidden" name="no_shipping" value="1" /> 
            <input type="hidden" name="currency_code" value="USD" /> 
            <input type="hidden" name="return" value="http://<?=$_SERVER['HTTP_HOST']?><?=option('base_uri')?>play?code=<?=$conversation[sessioncode]?>" />
            <a href="javascript:this.form.submit()">Click here to purchase</a>
        </form>
    </div>
</div>