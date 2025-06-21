import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// const isProduction = process.env.NODE_ENV == 'production';

// if(process.env.NODE_ENV === 'production') {
//     console.log('Production build');
// } else {
//     console.log('Development build');
// }

let isProduction = process.env.NODE_ENV;

const displayMode = () => {
    console.log('development mode:', isProduction);
}

export default defineConfig({
    build: {
        MODE: 'production',
    },
    // mode: process.env.NODE_ENV || 'development',
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        displayMode(),
    ],
});

