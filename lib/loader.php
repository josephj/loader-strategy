<?php
function loadModule($user_modules = array())
{
    require_once("config.php");

    // Set group basic data.
    $groups = array();
    foreach ($config["groups"] as $group_name => $group_data)
    {
        $groups[$group_name] = array(
            "combine"  => $group_data["combine"],
            "fetchCSS" => !($group_data["serverComboCSS"]),
            "root"     => $group_data["root"],
            "lang"     => $group_data["lang"],
            "modules"  => array(),
        );
    }

    // Get all required modules.
    $require_modules = array();
    foreach ($user_modules as $user_module)
    {
        $require_modules[] = $user_module;
        $target = $config["modules"][$user_module];
        if ( ! isset($target) || ! isset($target["requires"]))
        {
            continue;
        }
        $require_modules = array_merge($require_modules, $target["requires"]);
    }
    $require_modules = array_unique($require_modules);

    // Get all CSS files which need to be combined.
    $css_files = array();
    foreach ($require_modules as $require_module)
    {
        // Ignore for YUI modules which aren't defined in config.php.
        if ( ! array_key_exists($require_module, $config["modules"]))
        {
            continue;
        }

        $module = $config["modules"][$require_module];
        $group_name = $module["group"];
        $groups[$group_name]["modules"][$require_module] = array();
        if (isset($module["js"]))
        {
            $groups[$module["group"]]["modules"][$require_module] = array(
                "async"    => $module["async"],
                "path"     => $module["js"],
                "lang"     => $module["lang"],
                "requires" => $module["requires"],
            );
        }
        if (isset($module["css"]))
        {
            $groups[$group_name]["modules"]["$require_module"]["requires"][] = "$require_module-css";
            $groups[$group_name]["modules"]["$require_module-css"] = array(
                "path" => $module["css"],
                "type" => "css",
            );
            if ($config["groups"][$module["group"]]["serverComboCSS"])
            {
                $css_files[] = $groups[$group_name]["root"] . $module["css"];
            }
        }
    }

    $output = array();
    $output[] = '<link rel="stylesheet" href="./combo/?f=' . implode(",", $css_files) . '">';
    $output[] = '<script src="static/lib/yui/build/yui/yui-min.js"></script>';
    $output[] = '<script src="static/lib/mui/platform/core.js"></script>';
    $output[] = '<script src="static/lib/mui/platform/sandbox.js"></script>';
    $output[] = '<script src="static/lib/mui/platform/lang_service.js"></script>';
    $final    = array(
        "filter"   => "raw",
        "async"    => FALSE,
        "combine"  => true,
        "comboBase"=> "./combo/?f=",
        "comboSep" => ",",
        "root"     => "lib/yui/build/",
        "langs"     => "zh-TW,en-US",
        "groups"   => $groups,
    );
    $output[] = "<script>YUI_config = " . json_encode($final) . ";</script>";
    $output[] = "<script>YUI().use(\"" . implode("\",\"", $require_modules) . "\");</script>";
    return implode("\n", $output);
}

?>
