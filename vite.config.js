import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/images/photo.png',
                'resources/images/signature.png',
                'resources/images/document.jpg',
                'resources/images/c.id.jpg'
            ],
            refresh: true,
        }),
    ],
});
