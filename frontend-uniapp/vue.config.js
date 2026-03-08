module.exports = {
  transpileDependencies: ['tronweb'],
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
  devServer: {
    host: '0.0.0.0',
    port: 8080,
    allowedHosts: 'all',
    disableHostCheck: true,
    client: {
      webSocketURL: 'auto://0.0.0.0:0/ws'
    }
  }
};
