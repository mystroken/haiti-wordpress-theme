const path = require('path')

module.exports = {
	hot: true,
	port: 3000,
	proxy: {
    '/' : 'localhost:8080'
  },
	contentBase: './assets/dist/',
	publicPath: 'http://localhost:8080/wp-content/themes/genese/assets/dist/'
};
