/***********************************\
 * Laravel Mix configuration file. *
\***********************************/

/**
 * Laravel Mix configurator.
 *
 * @type {import("laravel-mix").Api}
 */
const mix = require("laravel-mix");

/**
 * Path resolver.
 *
 * @type {path.PlatformPath}
 */
const path = require("path");

require("mix-tailwindcss");
require("laravel-mix-polyfill");

//#region Webpack
mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                loader: "ts-loader",
                options: { appendTsSuffixTo: [/\.vue$/] },
                exclude: /node_modules/
            },
            {
                test: /\.d\.ts$/,
                loader: "ignore-loader",
                options: {
                    noEmit: false
                }
            }
        ]
    },
    resolve: {
        extensions: ["*", ".js", ".jsx", ".ts", ".d.ts", ".tsx", ".vue"],
        alias: {
            "@Interfaces": path.resolve(__dirname, "resources", "ts", "Interfaces"),
            "@Models": path.resolve(__dirname, "resources", "ts", "Models"),
            "@Components": path.resolve(__dirname, "resources", "vue", "Components"),
            "@Pages": path.resolve(__dirname, "resources", "vue", "Pages")
        }
    }
});
//#endregion

//#region JS
mix.ts("resources/ts/index.ts", "public/dist/js");
mix.js("resources/js/app.js", "public/dist/js");
mix.vue({ version: 3 });
//#endregion

//#region CSS
mix.sass("resources/scss/index.scss", "public/dist/css/app.css");
mix.postCss("resources/css/tailwind.css", "public/dist/css").tailwind("./tailwind.config.js");
//#endregion

//#region Polyfill
mix.polyfill({
    enabled: true,
    useBuiltIns: "usage",
    targets: false
});
//#endregion

//#region Files
mix.copy("resources/favicon/favicon.ico", "public/");
mix.copy("resources/imgs/*.*", "public/imgs/");
//#endregion

//#region Source
mix.version();
mix.sourceMaps(!mix.inProduction(), "eval-source-map");
//#endregion
