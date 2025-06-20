import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const isProduction = process.env.NODE_ENV == 'production';

export default defineConfig({
    build: {
        sourcemap: true,
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
});
