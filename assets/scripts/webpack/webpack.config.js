const path = require( 'path' );
const url = require( 'url' );
const webpack = require( 'webpack' );
const WriteFilePlugin = require( 'write-file-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

const { PATHS, HOST, PORT, THEME_NAME, PROXY_TARGET } = require( '../../config' );

const ENV = 'development';
const WATCH = global.watch || false;

module.exports = {
	mode: ENV,
	entry: getEntry(),

	output: {
		path: PATHS.compiled(),
		publicPath: `//${HOST}:${PORT}/wp-content/themes/${THEME_NAME}/assets/dist/`,
		filename: 'js/[name].js',
		sourceMapFilename: '[file].map'
	},

	devtool: 'cheap-source-map',

	devServer: {
		contentBase: PATHS.src(),
		watchContentBase: true,
		hot: true
	},

	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader'
				}
			},
			{
				test: /\.(sa|sc|c)ss$/,
				use: [
					'style-loader',
					'css-loader?importLoaders=1',
					'postcss-loader',
					'sass-loader'
				]
			}
		]
	},

	plugins: [
		new WriteFilePlugin(),
		new webpack.HotModuleReplacementPlugin(),
	],

	target: 'web',

	watch: WATCH
};

/*
 * CONFIG ENV DEFINITIONS
 */

function getEntry() {
	const entry = {};
	let proxyURL = `http://${HOST}:${PORT}`;
	entry.app = [ PATHS.src( 'js', 'app.js' ) ];
	entry.app.push( PATHS.src( 'sass', 'style.scss' ) );
	entry.app.push( PATHS.src( 'sass', 'woocommerce.scss' ) );

	/**
	 * We do this to enable injection over SSL.
	 */
	if ( 'https:' === url.parse( PROXY_TARGET ).protocol ) {
		process.env.NODE_TLS_REJECT_UNAUTHORIZED = 0;
		proxyURL = proxyURL.replace( 'http:', 'https:' );
	}

	entry.app.unshift( 'webpack/hot/only-dev-server' );
	entry.app.unshift( `webpack-hot-middleware/client?${proxyURL}` );

	return entry;
}

