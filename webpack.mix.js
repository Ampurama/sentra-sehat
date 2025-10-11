const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .react()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .version()
    .extract(['jquery', 'lodash', 'axios']) // Extract vendor libraries
    .minify('public/js/app.js')
    .minify('public/css/app.css')
    .options({
        processCssUrls: false,
        postCss: [
            require('autoprefixer')({
                grid: true,
            }),
        ],
    })
    .webpackConfig({
        resolve: {
            extensions: ['.js', '.jsx', '.json'],
        },
    });
