<!DOCTYPE html> 
<html lang="en">
<head> 
    <meta charset="utf-8" /> 
    <title><?=ApplicationName?> - <?=$title?></title> 
    <link rel="stylesheet" href="<?=option('base_uri')?>public/css/bootstrap.css" />
    <link rel="stylesheet" href="<?=option('base_uri')?>public/css/layout.css" />
    <link rel="shortcut icon" type="image/x-icon" href="<?=option('base_uri')?>public/img/logo.ico">
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/bootstrap-alerts.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/bootstrap-twipsy.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/bootstrap-popover.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/bootstrap-scrollspy.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/bootstrap-tabs.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/bootstrap-buttons.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/common.js"></script>
    <script type="text/javascript" src="<?=option('base_uri')?>public/js/audio-player.js"></script>  
    <script type="text/javascript">
        AudioPlayer.setup("http://<?=$_SERVER['HTTP_HOST']?>/public/js/player.swf", {
            width: 357,
            autostart: "yes",
            animation: "no"
        });
    </script>
</head> 
<body>
    <header class="jumbotron masthead" id="overview">
        <div class="inner">
            <div class="container">
                <h1>Recordable</h1>
                <p class="lead">Simple phone conversation recording.</p>
            </div>
        </div>
    </header>
    <div class="quickstart">
        <div class="container">
            <div class="row">
                <div class="span5">
                    <h6>Step One</h6>
                    <p>Dial <b>877-395-3442</b> from your phone.</p>
                </div>
                <div class="span5">
                    <h6>Step Two</h6>
                    <p>Follow the prompts and place your call.</p>
                </div>
                <div class="span5">
                    <h6>Step Three</h6>
                    <p>Receive your session code and enter it below.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <section class="content">
            <div class="page-header">
                <h1><?=$title?></h1>
            </div>
            <?php if ($_GET['error'] != null) { ?>
            <div class="alert-message error">
                <a class="close" href="#">&times;</a>
                <p><strong><?=$_GET['error']?></strong></p>
            </div>
            <?php } ?>
            <?php if ($_GET['warning'] != null) { ?>
            <div class="alert-message warning">
                <a class="close" href="#">&times;</a>
                <p><strong><?=$_GET['warning']?></strong></p>
            </div>
            <?php } ?>
            <?php if ($_GET['success'] != null) { ?>
            <div class="alert-message success">
                <a class="close" href="#">&times;</a>
                <p><strong><?=$_GET['success']?></strong></p>
            </div>
            <?php } ?>
            <?php if ($_GET['info'] != null) { ?>
            <div class="alert-message info">
                <a class="close" href="#">&times;</a>
                <p><strong><?=$_GET['info']?></strong></p>
            </div>
            <?php } ?>
            <?=$content?>
        </section>
        <footer>
            <p><a href="<?=option('base_uri')?>"><?=ApplicationName?></a> is powered by <a href="http://github.com/mccormicktechnologies/limoncello" target="_blank">Limoncello</a>. Version <?=Version?>.</p>
        </footer>
    </div>
    </body>
</html>
