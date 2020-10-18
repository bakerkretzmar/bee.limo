const mix = require('laravel-mix');
const path = require('path');
require('laravel-mix-svelte');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [require('tailwindcss')])
    .svelte({
        dev: !mix.inProduction(),
        emitCss: true,
    })
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.join(__dirname, 'resources/js'),
            },
        },
    })
    .version()
    .sourceMaps()
    .disableNotifications();
