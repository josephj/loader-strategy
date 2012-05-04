YUI.GlobalConfig = {
    combine  : true,
    comboBase: "./combo/?f=",
    root     : "lib/yui/build/",
    lang     : "zh-TW,en-US",
    filter   : {
        "searchExp": "&",
        "replaceStr": ","
    },
    filters: {
        "editable": "raw",
        "scroll-pagination": "raw"
    },
    groups: {
        mui: {
            combine: true,
            root: "lib/mui/",
            modules: {
                "editable": {
                    lang: ["en-US", "zh-TW"],
                    requires: [
                        "base", "panel", "event-mouseenter",
                        "event-delegate", "node-event-delegate",
                        "io-base", "escape", "intl"
                    ]
                },
                "scroll-pagination": {
                    requires: [
                        "event-screen", "event-resize", "node-event-delegate",
                        "datasource-io", "datasource-json-schema"
                    ]
                }
            }
        },
        demo: {
            combine: true,
            root: "static/demo/",
            modules: {
                "demo": {
                    lang: ["en-US", "zh-TW"]
                },
                "#sidebar": {
                    path: "_sidebar.js"
                },
                "#notification": {
                    path: "_notification.js",
                    requires: ["editable"]
                }
            }
        }
    }
};
