import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'
import laravel from 'laravel-vite-plugin'
import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import DefineOptions from 'unplugin-vue-define-options/vite'
import { fileURLToPath } from 'url'
import { defineConfig } from 'vite'
import Pages from 'vite-plugin-pages'
import Layouts from 'vite-plugin-vue-layouts'
import vuetify from 'vite-plugin-vuetify'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    laravel({
  input: ['resources/backend/ts/main.ts'],
  refresh: true,
}),
    vue({
  template: {
      transformAssetUrls: {
          base: null,
          includeAbsolute: false,
      },
  },
}),
    vueJsx(),

    // https://github.com/vuetifyjs/vuetify-loader/tree/next/packages/vite-plugin
    vuetify({
      styles: {
        configFile: 'resources/backend/styles/variables/_vuetify.scss',
      },
    }),
    Pages({
      dirs: ['./resources/backend/ts/pages'],
    }),
    Layouts({
      layoutsDirs: './resources/backend/ts/layouts/',
    }),
    Components({
      dirs: ['resources/backend/ts/@core/components', 'resources/backend/ts/views/demos'],
      dts: true,
    }),
    AutoImport({
      imports: ['vue', 'vue-router', '@vueuse/core', '@vueuse/math', 'pinia'],
      vueTemplate: true,
    }),

    DefineOptions(),
  ],
  define: { 'process.env': {} },
  resolve: {
    alias: {
      '@core-scss': fileURLToPath(new URL('./resources/backend/styles/@core', import.meta.url)),
      '@': fileURLToPath(new URL('./resources/backend/ts', import.meta.url)),
      '@themeConfig': fileURLToPath(new URL('./themeConfig.ts', import.meta.url)),
      '@core': fileURLToPath(new URL('./resources/backend/ts/@core', import.meta.url)),
      '@layouts': fileURLToPath(new URL('./resources/backend/ts/@layouts', import.meta.url)),
      '@images': fileURLToPath(new URL('./resources/backend/images/', import.meta.url)),
      '@styles': fileURLToPath(new URL('./resources/backend/styles/', import.meta.url)),
      '@configured-variables': fileURLToPath(new URL('./resources/backend/styles/variables/_template.scss', import.meta.url)),
      '@axios': fileURLToPath(new URL('./resources/backend/ts/plugins/axios', import.meta.url)),
      '@validators': fileURLToPath(new URL('./resources/backend/ts/@core/utils/validators', import.meta.url)),
      'apexcharts': fileURLToPath(new URL('node_modules/apexcharts-clevision', import.meta.url)),
    },
  },
  build: {
    chunkSizeWarningLimit: 5000,
  },
  optimizeDeps: {
    exclude: ['vuetify'],
    entries: [
      './resources/backend/ts/**/*.vue',
    ],
  },
})
