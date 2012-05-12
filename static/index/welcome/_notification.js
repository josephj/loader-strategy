YUI.PlatformModules["notification"] = (function () {
    var _api,
        _node,
        _panel,
        _template,
        API_KEY   = "06c6e0a6adaa92715c7eee7634f4ec98",
        YQL_QUERY = 'select * from flickr.photos.search(0,100) where text="{keyword}" and api_key="{api_key}" and sort="interestingness-desc"',
        init,
        onviewload;

    init = function (sandbox) {
        _api = sandbox;
    };

    onviewload = function () {
        _api.log("onviewload() is executed.");
        _node = _api.getViewNode();
        var query = Y.substitute(YQL_QUERY, {
            api_key: API_KEY,
            keyword: "miiiCasa"
        });

        var source = _node.one("#list-template").getContent();
        _template = Y.Handlebars.compile(source);

        Y.YQL(query, function (o) {
            _node.one(".bd ul").append(_template(o.query.results));
        });

        _panel = new Y.Panel({
            render: true,
            visible: false,
            centered: true,
            width: 850,
            height: 600,
            zIndex: 2
        });


        _node.one(".bd").delegate("click", function (e) {
            e.preventDefault();
            var node = e.currentTarget.one("img");
            _panel.set("headerContent", node.get("title"));
            _panel.set("bodyContent", [
                "<div style='text-align:center'>",
                    "<img src='" + node.get("src").replace("_q", "_c") + "'>",
                "</div>"
            ].join(""));
            _panel.show();
        }, "a.photo-link");

    };

    /**
     * Module message receive
     *
     * @event onmessage
     * @public
     * @return void
     */
    onmessage = function (eventName, callerId, callerData) {
        Y.log("onmessage() " + eventName, "info", MODULE_ID);

    };


    return {
        init: init,
        onviewload: onviewload,
        onmessage: onmessage
    };

}());
