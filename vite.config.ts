import { fileURLToPath, URL } from 'node:url';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/ts/app.ts'],
            refresh: ['resources/views/**', 'Modules/**/resources/views/**'],
        }),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/ts', import.meta.url)),
        },
    },
    build: {
        target: 'es2022',
        cssCodeSplit: false,
    },
});
