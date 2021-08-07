module.exports = {
  transpileDependencies: [
    'vuetify',
  ],
  devServer: {
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
