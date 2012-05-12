<?php
require_once("lib/loader.php");
$modules = array(
    "welcome",
    "welcome/_notification",
    "charming/_masthead",
    "common/_sidebar",
);
$loader_html = loadModule($modules);
$loader_html = str_replace("\/", "/", $loader_html);
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>miiiCasa Loader Strategy</title>
<link rel="stylesheet" href="combo?g=css">
<?php echo $loader_html; ?>
</head>
<body class="yui3-skin-sam yui3-skin-miiicasa">
    <div id="hd">
        <div class="content">
            <h1>miiiCasa Loader Strategy</h1>
            <div class="introduction">
                <p>
                    模組化設計是當代前端開發的趨勢、
                    不應設定每個 Page 有哪些 JavaScript 檔案需要載入、
                    應反向思考：「<em>設定每個模組所需要的 JavaScript 檔案各有哪些、
                    以此為基礎、自動計算出 Page 所有的 JavaScript 檔案並動態載入。</em>」
                    YUI 的模組與 Loader 架構讓這樣的概念很容易地被實作。
                </p>
                <p>
                    另外還要考量的是 CSS。CSS 一樣可以依模組關係被計算出來，
                    但是樣式這東西必須比 JavaScript 還早載入，
                    <em>傳統的 &lt;link/&gt; 反而必較符合大多數人的需求</em>。
                    （YUI Loader 沒辦法做到、但若你的 Server 是 nodeJS 則另當別論）
                </p>
                <p>
                    我以 PHP 為後端，每個模組的開發者需各自去 config.php 註冊自己的模組：
                    提供此模組 JavaScript 與 CSS 的路徑、及相依的模組名稱列表。
                    在 &lt;/head&gt; 前寫入此 PHP 後，會<em>以最佳效能、非同步、檔案動態在伺服器端合併的方式載入 CSS 與 JavaScript 檔案</em>
                    （請以 Firebug 或 Chrome 的開發人員工具觀看）：
                </p>
                <pre class="sh_php">&lt;?php echo loadModule("_masthead", "_sidebar", "_notification"); ?&gt;</pre>
            </div>
            <!-- #masthead (start) -->
            <div id="masthead" class="mod">
                <div class="hd">
                    <h2>模組 charming/_masthead</h2>
                    <p>此模組的對應 PHP 設定：</p>
                    <pre class="sh_php">
&lt;?php
"charming/_masthead" => array(
    "group"    => "index",
    "js"       => "charming/_masthead.js",
    "css"      => "charming/_masthead.css",
    "requires" => array("panel", "syntax-highlighter"),
)
?&gt;
</pre>
                </div>
                <div class="bd">
                </div>
            </div>
            <!-- #masthead (end) -->
        </div>
    </div>
    <div id="bd">
        <div class="yui3-g">
            <div class="yui3-u-7-24">
                <div class="content">
                    <!-- #sidebar (start) -->
                    <div id="sidebar" class="mod">
                        <div class="hd">
                            <h2>模組 common/_sidebar</h2>
                            <p>此模組的對應 PHP 設定：</p>
                            <pre class="sh_php">
"common/_sidebar" => array(
    "group"    => "index",
    "css"      => "welcome/_sidebar.css",
    "requires" => array("mui-cssbutton"),
),
</pre>
                        </div>
                        <div class="bd">
                            <button class="yui3-button yui3-button-exclusive">Exclusive Button</button><br>
                            <button class="yui3-button yui3-button-task">Task Button</button><br>
                            <button class="yui3-button yui3-button-form">Form Button</button><br>
                            <button class="yui3-button yui3-button-edit">Edit Button</button><br>
                            <button class="yui3-button yui3-button-stick">Table Button</button><br>
                            <button class="yui3-button yui3-button-table">Stick Button</button><br>
                            <button class="yui3-button">Basic Button</button><br>
                        </div>
                    </div>
                    <!-- #sidebar (end) -->
                </div>
            </div>
            <div class="yui3-u-17-24">
                <div class="content">
                    <!-- #notification (start) -->
                    <div id="notification" class="mod">
                        <div class="hd">
                            <h2>模組 welcome/_notification</h2>
                            <p>此模組的對應 PHP 設定：</p>
                            <pre class="sh_php">
"welcome/_notification" => array(
    "group"    => "index",
    "js"       => "welcome/_notification.js",
    "css"      => "welcome/_notification.css",
    "requires" => array(
        "substitute", "scroll-pagination",
        "yql", "panel", "node-event-delegate",
        "handlebars"
    ),
),
</pre>
                        </div>
                        <div class="bd">
                            <ul class="clearfix"></ul>
                        </div>
                        <script id="list-template" type="text/x-handlebars-template">
                        {{#photo}}
                            <li>
                                <a class="photo-link" href="http://www.flickr.com/photos/{{owner}}/{{id}}">
                                    <img src="http://farm{{farm}}.static.flickr.com/{{server}}/{{id}}_{{secret}}_q.jpg" width="150" height="150" title={{{title}}}>
                                </a>
                                <div>{{title}}</div>
                            </li>
                        {{/photo}}
                        </script>
                    </div>
                    <!-- #notification (end) -->
                </div>
            </div>
        </div>
    </div>
    <textarea style="width:100%;height:200px;font-size:12px;font-family:Monaco;"><?php echo $loader_html; ?></textarea>
</body>

</html>
