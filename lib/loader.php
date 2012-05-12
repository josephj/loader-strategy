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

    foreach ($require_modules as $require_module)
    {
        $target = $config["modules"][$require_module];
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
        if (isset($module["js"]))
        {
            $data = array();
            if (isset($module["js"]))
            {
                $data["path"] = $module["js"];
            }
            if (isset($module["lang"]))
            {
                $data["lang"] = $module["lang"];
            }
            if (isset($module["async"]))
            {
                $data["async"] = $module["async"];
            }
            if (isset($module["requires"]))
            {
                $data["requires"] = $module["requires"];
            }
            $groups[$module["group"]]["modules"][$require_module] = $data;
        }
        if (isset($module["css"])) // Deal with CSS setting.
        {
            if (isset($module["js"]) && isset($module["css"])) // CSS with JS.
            {
                if ($config["groups"][$group_name]["serverComboCSS"]) // Combo by server.
                {
                    $css_files[] = $groups[$group_name]["root"] . $module["css"];
                }
                else // Not combo by server.
                {
                    $groups[$group_name]["modules"]["$require_module-css"] = array(
                        "path" => $module["css"],
                        "type" => "css",
                    );
                    $groups[$group_name]["modules"]["$require_module"]["requires"][] = "$require_module-css";
                }
            }
            else if ( ! isset($module["js"]) && isset($module["css"])) // Pure CSS Group
            {
                if ($config["groups"][$group_name]["serverComboCSS"]) // Combo by server.
                {
                    $css_files[] = $groups[$group_name]["root"] . $module["css"];


                    if (isset($module["requires"]))
                    {
                        $groups[$group_name]["modules"]["$require_module"]["requires"] = $module["requires"];
                    }
                    else
                    {
                        // Remove this module.
                        for ($i = count($user_modules) - 1, $j = 0; $i >= $j; $i--)
                        {
                            if ($user_modules[$i] === $require_module)
                            {
                                array_splice($user_modules, $i, 1);
                            }
                        }
                    }
                }
                else // Not combo by server.
                {
                    $groups[$group_name]["modules"]["$require_module"] = array(
                        "path" => $module["css"],
                        "type" => "css",
                    );
                }
            }
        }
    }

    $output = array();
    $output[] = '<link rel="stylesheet" href="combo/?g=css&f=' . implode(",", $css_files) . '">';
    $output[] = '<script src="combo/?g=js"></script>';
    $final    = array(
        "filter"   => "raw",
        "async"    => FALSE,
        "combine"  => TRUE,
        "comboBase"=> "combo/?f=",
        "comboSep" => ",",
        "root"     => "lib/yui/build/",
        "langs"     => "zh-TW,en-US",
        "groups"   => $groups,
    );
    $output[] = "<script>YUI_config = " . json_encode($final) . ";</script>";
    $output[] = "<script>YUI().use(\"" . implode("\",\"", $user_modules) . "\");</script>";
    return implode("\n", $output);
}

?>
