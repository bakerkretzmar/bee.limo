import { defineConfig } from 'vite';
import { fileURLToPath, URL } from 'node:url';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        svelte(),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
            ziggy: fileURLToPath(new URL('./vendor/tightenco/ziggy', import.meta.url)),
        },
    },
});
