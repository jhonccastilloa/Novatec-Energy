import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  build: {
    outDir: 'assets/react',
    emptyOutDir: true,
    rollupOptions: {
      input: 'src/product-taxonomy.tsx',
      output: {
        entryFileNames: 'product-taxonomy.js',
        chunkFileNames: 'product-taxonomy-[hash].js',
        assetFileNames: 'product-taxonomy.[ext]'
      }
    }
  }
});
