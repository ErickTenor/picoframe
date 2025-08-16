import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';

export default defineConfig({
    plugins: [
        liveReload([
            __dirname + '/app/**/*.php',
            __dirname + '/app/**/*.twig',
            __dirname + '/routes/**/*.php',
        ]),
    ],

    build: {
        outDir: '/public/build',
        manifest: true,
        rollupOptions: {
            input: 'resources/js/app.js',
        },
    },

    server: {
        host: 'localhost',
        hmr: {
            host: 'localhost',
        },
    },
});