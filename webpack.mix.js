const mix = require('laravel-mix')
const path = require('path')

mix.disableNotifications()

mix
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('postcss-nesting'),
    ])
    .js('resources/js/app.js', 'public/js')
    .webpackConfig({
        output: { chunkFilename: 'js/[name].js' },
        resolve: {
            mainFields: ['svelte', 'browser', 'module', 'main'],
            alias: {
                '@': path.resolve('resources/js'),
                svelte: path.resolve('node_modules', 'svelte'),
            },
        },
        module: {
            rules: [
                {
                    test: /\.(svelte)$/,
                    use: {
                        loader: 'svelte-loader',
                        options: {
                            dev: process.env.NODE_ENV !== 'production',
                            emitCss: true,
                        },
                    },
                }
            ]
        },
    })
    .version()

