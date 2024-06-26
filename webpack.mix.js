const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/scss/app.scss", "public/assets/css")
    .minify("public/assets/css/app.css")
    // .sass("resources/scss/app-dark.scss", "public/assets/css")
    // .minify("public/assets/css/app-dark.css")
    .sass("resources/scss/bootstrap.scss", "public/assets/css")
    .minify("public/assets/css/bootstrap.css")
    // .sass("resources/scss/bootstrap-dark.scss", "public/assets/css")
    // .minify("public/assets/css/bootstrap-dark.css")
    .sass("resources/scss/icons.scss", "public/assets/css")
    .minify("public/assets/css/icons.css")
    .webpackConfig(require("./webpack.config"));

if (mix.inProduction()) {
    mix.version();
}
