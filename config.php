<?php
$config = array();
$config["groups"] = array(
    "mui" => array(
        "serverComboCSS" => FALSE,
        "root"           => "lib/mui/",
        "lang"           => array("en-US", "zh-TW"),
    ),
    "index" => array(
        "serverComboCSS" => TRUE,
        "root"           => "index/",
        "lang"           => array("en-US", "zh-TW"),
    ),
);
$config["modules"] = array(
    "scroll-pagination" => array(
        "group"    => "mui",
        "js"       => "scroll-pagination/scroll-pagination.js",
        "css"      => "scroll-pagination/assets/scroll-pagination.css",
        "requires" => array("event-screen", "event-resize", "node-event-delegate", "datasource-io", "datasource-json-schema"),
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
        "requires" => array("platform-core", "platform-base"),
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


function loadModule($modules = array())
{
    global $config;

    $requires = array();
    foreach ($modules as $module)
    {
        $v = $config["modules"][$module];
        if ( ! isset($v) || ! isset($v["requires"]))
        {
            continue;
        }
        $requires[] = $module;
        $requires = array_merge($requires, $v["requires"]);
    }
    $requires = array_unique($requires);

    $groups   = array();
    foreach ($config["groups"] as $k => $v)
    {
        $groups[$k] = array(
            "fetchCSS" => !($v["serverComboCSS"]),
            "root"     => $v["root"],
            "lang"     => $v["lang"],
            "modules"  => array(),
        );
    }

    $css_files = array();
    foreach ($requires as $require)
    {
        if ( ! array_key_exists($require, $config["modules"]))
        {
            continue;
        }
        $module = $config["modules"][$require];
        $groups[$module["group"]]["modules"][$require] = array();
        if (isset($module["js"]))
        {
            $groups[$module["group"]]["modules"][$require] = array(
                "path"     => $module["js"],
                "requires" => $module["requires"],
            );
        }
        if (isset($module["css"]))
        {
            $groups[$module["group"]]["modules"]["$require"]["requires"][] = "$require-css";
            $groups[$module["group"]]["modules"]["$require-css"] = array(
                "path" => $module["css"],
                "type" => "css",
            );
            if ($config["groups"][$module["group"]]["serverComboCSS"])
            {
                $css_files[] = $groups[$module["group"]]["root"] . $module["css"];
            }
        }
    }

    $css_output = "<link rel=\"stylesheet\" href=\"./combo/?f=" . implode(",", $css_files) . "\">";

    $yui_config_output = array(
        "filter"   => "raw",
        "combine"  => true,
        "comboBase"=> "./combo/?f=",
        "comboSep" => ",",
        "root"     => "lib/yui/build/",
        "lang"     => "zh-TW,en-US",
        "groups"   => $groups,
    );
    $yui_output = "<script src=\"static/lib/yui/build/yui/yui-min.js\"></script>";
    $yui_config_output = "<script>YUI_config = " . json_encode($yui_config_output) . ";</script>";
    $use_output = "<script>YUI().use(\"" . implode("\",\"", $requires) . "\");</script>";
    return implode("\n", array(
        $css_output,
        $yui_output,
        $yui_config_output,
        $use_output,
    ));

}

?>
