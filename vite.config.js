import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    build: {
        // Generate smaller chunks
        chunkSizeWarningLimit: 500,
        rollupOptions: {
            output: {
                // Manual chunks: split Bootstrap JS out since it's loaded from CDN anyway
                manualChunks: undefined,
                // Compact asset file names
                assetFileNames: 'assets/[name]-[hash][extname]',
                chunkFileNames: 'assets/[name]-[hash].js',
                entryFileNames: 'assets/[name]-[hash].js',
            },
        },
        // Minify with esbuild (default, fast)
        minify: 'esbuild',
        // Don't generate source maps in production
        sourcemap: false,
        // Enable CSS code splitting
        cssCodeSplit: true,
    },
});
