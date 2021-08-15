module.exports = {
  transpileDependencies: [
    'vuetify',
  ],
  devServer: {
    port: 8081,
    proxy: {
      '^/api': {
        target: process.env.APP_URL,
      },
    },
  },
  publicPath: process.env.NODE_ENV === 'production' ? 'assets' : '',
  outputDir: 'public/assets',
  indexPath: '../../resources/views/index.html',
};
