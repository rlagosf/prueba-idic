import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin'; // Importamos el plugin de Laravel para Vite
import vue from '@vitejs/plugin-vue'; // Importamos el plugin de Vue para Vite

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // Archivo principal de estilos SCSS
                'resources/js/app.js', // Archivo principal de JavaScript
            ],
            refresh: true, // Habilita la recarga automática cuando hay cambios
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null, // Deshabilita la base URL automática
                    includeAbsolute: false, // No incluye URLs absolutas
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js', // Alias para Vue en su versión ESM
        },
    },
});

