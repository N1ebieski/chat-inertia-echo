const mix = require('laravel-mix')
const LaravelZiggyGenerator = require('laravel-ziggy-generator-webpack')
const path = require('path')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    plugins: [
        new LaravelZiggyGenerator()
    ],
    resolve: {
        alias: {
            '~': path.resolve(__dirname, 'node_modules/'),
            ziggy: path.resolve('vendor/tightenco/ziggy/src/js/route.js')
        }
    }
})

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    // .postCss('resources/css/app.css', 'public/css', [
    //     //
    // ])
    .browserSync({
        proxy: 'https://chat-inertia-echo.local:8443',
        port: 3000,
        host: 'chat-inertia-echo.local',
        open: 'external',
        snippetOptions: {
            rule: {
                match: /<\/body>/i,
                fn: function (snippet, match) {
                    return snippet + match
                }
            }
        }
    })

if (mix.inProduction()) {
    mix.version()
}
