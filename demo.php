<?php
require_once("lib/loader.php");
$modules = array(
    "welcome",
    "welcome/_notification",
    "charming/_masthead",
    "common/_sidebar",
);
$loader_html = loadModule($modules);
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Loader Strategy</title>
<link rel="stylesheet" href="static/lib/yui/build/cssreset/reset-min.css">
<link rel="stylesheet" href="static/lib/yui/build/cssfonts/fonts-min.css">
<link rel="stylesheet" href="static/lib/yui/build/cssgrids/grids-min.css">
<link rel="stylesheet" href="static/index/common/base.css">
<?php echo $loader_html; ?>
</head>
<body>
    <div id="hd">
        <div class="content">
            <!-- #masthead (start) -->
            <div id="masthead" class="mod">
                <div class="hd">
                    <h2>#masthead</h2>
                </div>
                <div class="bd">
                    <ul>
                        <li>
                            <h3>自身所需模組</h3>
                            <ul>
                                <li>_masthead.css</li>
                                <li>_masthead.js</li>
                            </ul>
                            <h3>YUI 模組</h3>
                            <ul>
                                <li>panel</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- #masthead (end) -->
        </div>
    </div>
    <div id="bd">
        <div class="yui3-g">
            <div class="yui3-u-5-24">
                <div class="content">
                    <!-- #sidebar (start) -->
                    <div id="sidebar" class="mod">
                        <div class="hd">
                            <h2>#sidebar</h2>
                        </div>
                        <div class="bd">
                            <ul>
                                <li>
                                    <h3>自身所需模組</h3>
                                    <ul>
                                        <li>_sidebar.css</li>
                                        <li>_sidebar.js</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- #sidebar (end) -->
                </div>
            </div>
            <div class="yui3-u-19-24">
                <div class="content">
                    <!-- #notification (start) -->
                    <div id="notification" class="mod">
                        <div class="hd">
                            <h2>#notification</h2>
                        </div>
                        <div class="bd">
                            <ul>
                                <li>
                                    <h3>自身所需模組</h3>
                                    <ul>
                                        <li>_notification.css</li>
                                        <li>_notification.js</li>
                                    </ul>
                                </li>
                                <li>
                                    <h3>YUI 模組</h3>
                                    <ul>
                                        <li>scroll-pagination</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- #notification (end) -->
                </div>
            </div>
        </div>
    </div>
    <textarea style="width:100%;height:200px;font-size:12px;font-family:Monaco;"><?php echo $loader_html; ?></textarea>
</body>
</html>
