YUI.add("welcome", function (Y) {
    window.Y = Y;
    var core = Y.PlatformCore;
    core.setLangModule("welcome");
    core.setLang(Y.config.lang);
    core.registerAll(YUI.PlatformModules);
});
