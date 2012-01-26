<div class="row">
    <div class="span15">
        <p>To listen to this recording online, there is a one-time fee of <b>$<?=(0.35 + (ceil($conversation[duration] / 60) * 0.10))?></b>. This payment can be completed online and offers unlimited access to your recording.</p>
        <br />
        <a href="<?=option('base_uri')?>download/<?=$conversation[sessioncode]?>" target="_blank">Click here to purchase</a>
    </div>
</div>