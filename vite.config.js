import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/manage/app.css',
                'resources/js/manage/init.js',
                'resources/js/manage/initManage.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        sourcemap: true
    }
});
