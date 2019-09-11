const mix = require('laravel-mix')
const path = require('path')

mix
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('postcss-nesting'),
    ])
    .babelConfig({
        plugins: ['@babel/plugin-syntax-dynamic-import'],
    })
    .webpackConfig({
        output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
        resolve: {
            mainFields: ['svelte', 'browser', 'module', 'main'],
            alias: {
                '@': path.resolve('resources/js'),
            },
        },
        module: {
            rules: [
                {
                    test: /\.(svelte)$/,
                    use: {
                        loader: 'svelte-loader',
                        options: {
                            emitCss: true,
                            hotReload: true,
                        },
                    },
                }
            ]
        },
    })
    .version()
