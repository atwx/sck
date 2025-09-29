import {defineConfig} from 'vite'

// https://vitejs.dev/config/
export default defineConfig(({command}) => {
  return {
    server: {
      host: '0.0.0.0',
      port: 5173,
    },
    alias: {
      alias: [{find: '@', replacement: './app/client/src'}],
    },
    // base: (command === 'build') ? '/_resources/app/client/dist/' : '/', // TODO: .env variable, only on build
    base: './',
    publicDir: 'app/client/public',
    build: {
      // cssCodeSplit: false,
      outDir: './app/client/dist',
      manifest: true,
      sourcemap: true,
      rollupOptions: {
        input: {
          'bundle.js': './app/client/src/bundles/bundle.js',
          'bundle.scss': './app/client/src/styles/bundle.scss',
        },
      },
    },
    css: {
        devSourcemap: true,
    },
    plugins: []
  }
})
