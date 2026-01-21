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
    build: {
        // Laravel secara default menggunakan public/build
        // Pastikan ini sesuai dengan folder yang akan di-deploy
        outDir: 'public/build',
        emptyOutDir: true
    }
});