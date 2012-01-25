<?php

    require_once "library/limonade.php";
    require_once "library/lightopenid/openid.php";
    require_once "library/twilio/Twilio.php";
    
    require("config/config.php");
    require("library/utils.php");
    require("library/security.php");
    
    /* Establish database connection */
    $con = mysql_connect(Server, Username, Password);
    mysql_select_db(Database, $con);
    
    /* Modify configuration settings */
    function configure()
    {
        option('base_uri', '/');
        option('public_dir', 'public/');
        option('views_dir', 'views/');
        option('controllers_dir', 'controllers/');
    }
    
    /* Declare default layout page */
    function before()
    {
        layout('layout.php');
    }
    
    /* Declare default error page */
    function server_error($errno, $errstr, $errfile=null, $errline=null)
    {
        $args = compact('errno', 'errstr', 'errfile', 'errline');   
        return html("error/error.php", "layout.php", $args);
    }
    
    /* Declare Common routes */
    dispatch('/', 'common_home');
    dispatch('/play/:session', 'common_play');
    dispatch('/download/:session', 'common_download');
    dispatch_post('/payment', 'common_payment');

    /* Declare Inbound routes */
    dispatch_post('/inbound/voice/menu', 'inbound_voice_menu');
    dispatch_post('/inbound/voice/prompt', 'inbound_voice_prompt');
    dispatch_post('/inbound/voice/record', 'inbound_voice_record');
    dispatch_post('/inbound/voice/complete', 'inbound_voice_complete');
    dispatch_post('/inbound/voice/transcript', 'inbound_voice_transcript');
    dispatch_post('/inbound/voice/play', 'inbound_voice_play');
    
    run();
    
?>