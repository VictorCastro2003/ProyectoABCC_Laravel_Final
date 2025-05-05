import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // Configuración crucial para producción:
    base: process.env.NODE_ENV === 'production' ? '/build/' : '/',
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name].[hash].js',
                chunkFileNames: 'assets/[name].[hash].js',
                assetFileNames: 'assets/[name].[hash].[ext]',
            }
        }
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    }
});
