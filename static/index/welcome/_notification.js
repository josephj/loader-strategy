YUI.PlatformModules["#notification"] = function () {
    var _api,
        _node,
        init,
        onviewload;

    init = function (sandbox) {
        _api = sandbox;
    };

    onviewload = function () {
        _api.log("onviewload() is executed.");
        alert(Y.ScrollPagination);
    };

    return {
        init: init,
        onviewload: onviewload
    }

}();
