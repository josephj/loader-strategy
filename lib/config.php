<?php
$config = array();
$config["groups"] = array(
    "mui" => array(
        "async"          => TRUE,
        "combine"        => TRUE,
        "serverComboCSS" => FALSE,
        "root"           => "lib/mui/",
        "lang"           => array("en-US", "zh-TW"),
    ),
    "index" => array(
        "async"          => FALSE,
        "combine"        => TRUE,
        "serverComboCSS" => TRUE,
        "root"           => "index/",
        "lang"           => array("en-US", "zh-TW"),
    ),
);
$config["modules"] = array(
    //"platform-core" => array(
        //"group"    => "mui",
        //"js"       => "platform/core.js",
        //"requires" => array("event-base", "platform-sandbox"),
    //),
    //"platform-sandbox" => array(
        //"group"    => "mui",
        //"js"       => "platform/sandbox.js",
    //),
    //"lang-service" => array(
        //"group"    => "mui",
        //"js"       => "platform/lang_service.js",
        //"requires" => array(
            //"platform-core", "platform-sandbox", "intl"
        //),
    //),
    "scroll-pagination" => array(
        "group"    => "mui",
        "js"       => "scroll-pagination/scroll-pagination.js",
        "css"      => "scroll-pagination/assets/scroll-pagination.css",
        "requires" => array("event", "event-resize", "node-event-delegate", "datasource"),
    ),
    "editable" => array(
        "group"    => "mui",
        "js"       => "editable/editable.js",
        "css"      => "editable/assets/skins/miiicasa/editable.js",
        "requires" => array(
            "base", "panel", "event-mouseenter",
            "event-delegate", "node-event-delegate",
            "io-base", "escape", "intl"
        ),
    ),
    "welcome" => array(
        "group"    => "index",
        "js"       => "welcome/welcome.js",
        "lang"     => array("en-US", "zh-TW"),
        "requires" => array("platform-core", "platform-sandbox", "lang-service"),
    ),
    "welcome/_notification" => array(
        "group"    => "index",
        "js"       => "welcome/_notification.js",
        "css"      => "welcome/_notification.css",
        "requires" => array("scroll-pagination", "io"),
    ),
    "charming/_masthead" => array(
        "group"    => "index",
        "js"       => "charming/_masthead.js",
        "css"      => "charming/_masthead.css",
        "requires" => array("panel"),
    ),
    "common/_mastfoot" => array(
        "group"    => "index",
        "css"      => "common/_mastfoot.css",
    ),
    "common/_sidebar" => array(
        "group"    => "index",
        "css"      => "common/_sidebar.css",
    ),
);

?>
