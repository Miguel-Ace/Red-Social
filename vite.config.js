import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/plantilla.scss',
                'resources/sass/plantilla-auth.scss',
                'resources/sass/modal.scss',
                'resources/js/app.js',
                'resources/js/plantilla.js',
                'resources/js/login.js',
                'resources/js/addTokenAdmin.js',
                'resources/js/tokens-innovacion.js',
                'resources/js/pais.js',
                'resources/js/modal.js',
            ],
            refresh: true,
        }),
    ],
});
