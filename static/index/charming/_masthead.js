YUI.PlatformModules["masthead"] = (function () {
    var _api,
        _node,
        init,
        onviewload;

    init = function (sandbox) {
        _api = sandbox;
    };

    onviewload = function () {
        _api.log("onviewload() is executed.");
        _node = _api.getViewNode();
        sh_highlightDocument();
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
