module.exports = {
  transpileDependencies: ['tronweb'],
  devServer: {
    host: '0.0.0.0',
    port: 8080,
    allowedHosts: 'all',
    client: {
      webSocketURL: 'auto://0.0.0.0:0/ws'
    },
    proxy: {
      '/api': {
        target: 'https://mxtrx.top',
        changeOrigin: true,
        pathRewrite: { '^/api': '/index.php/api' }
      }
    }
  },
  chainWebpack: config => {
    config.module
      .rule('vue')
      .use('vue-loader')
      .loader('vue-loader')
      .tap(options => {
        options.optimizeSSR = false;
        options.compilerOptions = { preserveWhitespace: false };
        return options;
      });
  },
};
