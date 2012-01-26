<div class="row">
    <div class="span15">
        <p>To purchase online access to this recording, click the link below. The total for this recording is <b>$<?=(0.35 + (ceil($conversation[duration] / 60) * 0.10))?></b>, a one-time payment that provides unlimited access to your recording.</p>
        <br />
        <a href="<?=option('base_uri')?>download/<?=$conversation[sessioncode]?>" target="_blank">Click here to purchase</a>
    </div>
</div>