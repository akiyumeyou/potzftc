import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/chat.js',
                'resources/js/senryu.js',
                'resources/js/stamp.js',
                'resources/css/app.css',
                'resources/css/senryu.css',
                'resources/css/tweet.css'
            ],
            refresh: true,
        }),
    ],
});
