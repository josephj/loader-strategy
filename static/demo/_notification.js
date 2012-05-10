YUI.PlatformModules["#notification"] = function () {
    var _api,
        _node,
        init,
        onviewload;

    init = function (sandbox) {
        _api = sandbox;
        alert(Y.Editable);
    };

    onviewload = function () {
        _api.log("onviewload() is executed.");

        alert(Y.Editable);

    };

    return {
        init: init,
        onviewload: onviewload
    }

}();
