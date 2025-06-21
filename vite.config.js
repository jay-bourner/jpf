import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        mode: isProduction = 'production',
        sourcemap: true,
        watch: {
            mode: isProduction = 'development',
            sourcemap: true,
        },
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        console.log('Vite configuration loaded in ' + isProduction  + ' mode.'),
    ],
});

