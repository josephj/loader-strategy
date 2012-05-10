<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Loader Strategy</title>
<link rel="stylesheet" href="http://yui.yahooapis.com/3.5.0/build/cssreset/reset-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/3.5.0/build/cssfonts/fonts-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/3.5.0/build/cssgrids/grids-min.css">
<?php
require_once("config.php");
$html = loadModule(array("welcome/_notification", "common/_sidebar", "charming/_masthead"));
echo $html;
?>
</head>
<body>

    <div id="hd">
        <div class="content">
            <!-- #header (start) -->
            <div id="header" class="mod">
                <div class="hd">
                    <h2>#header</h2>
                </div>
                <div class="bd">
                    <ul>
                        <li>
                            <h3>自身所需模組</h3>
                            <ul>
                                <li>_header.css</li>
                                <li>_header.js</li>
                            </ul>
                            <h3>YUI 模組</h3>
                            <ul>
                                <li>panel</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- #header (end) -->
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

</body>
</html>