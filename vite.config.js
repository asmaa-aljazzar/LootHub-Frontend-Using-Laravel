import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/app-admin.css',
                'resources/js/app.js',
                'resources/js/admin-app.js',
                'resources/js/product-3d.js',
                'resources/js/checkout-map.js',
                'resources/js/ai-products.js',
                'resources/js/ai-studio-cart.js',
                'resources/js/catalog-filter-fix.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
