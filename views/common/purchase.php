<div class="row">
    <div class="span15">
        <audio controls="controls" autoplay="autoplay">
            <source src="<?=$conversation[recordingurl]?>.mp3" type="audio/mpeg" />
            Your browser does not support audio playback.
        </audio>
        <br />
        <br />
        <p>This conversation took place on <?=date("F j, Y", strtotime($conversation[createddate]))?> between <?=$caller?> and <?=$called?> and lasted <?=round($conversation[duration]/60)?> minutes.</p>
        <br />
        <a href="<?=option('base_uri')?>download/<?=$conversation[sessioncode]?>" target="_blank">Click here to download</a>
    </div>
</div>