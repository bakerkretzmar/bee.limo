const mix = require('laravel-mix');
const path = require('path');
require('laravel-mix-svelte');

mix.disableNotifications();

mix.postCss('resources/css/app.css', 'public/css', [require('tailwindcss')])
    .js('resources/js/app.js', 'public/js')
    .babelConfig({
        plugins: ['@babel/plugin-proposal-optional-chaining'],
    })
    .svelte({
        dev: !mix.inProduction(),
        emitCss: true,
    })
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve('resources/js'),
            },
        },
    })
    .version()
    .sourceMaps();
