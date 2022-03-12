global.watch = true;

const fs = require( 'fs-extra' );
const browserSync = require( 'browser-sync' ).create();
const webpack = require( 'webpack' );
const webpackDevMiddleware = require( 'webpack-dev-middleware' );
const webpackHotMiddleware = require( 'webpack-hot-middleware' );
const htmlInjector = require( 'bs-html-injector' );
const webpackConfig = require( './webpack.config' );

const bundler = webpack( webpackConfig );
const { PATHS, PROXY_TARGET } = require( '../../config' );


const bsOptions = {
	open: false,
	proxy: {

		// proxy local WP install
		target: PROXY_TARGET,

		middleware: [

			// converts browsersync into a webpack-dev-server
			webpackDevMiddleware( bundler, {
				publicPath: webpackConfig.output.publicPath
			}),

			// hot update js & css
			webpackHotMiddleware( bundler )

		]
	}
};


// setup html injector, only compare differences within outer most div (#page)
// otherwise, it will replace the webpack HMR scripts
browserSync.use( htmlInjector, {
	restrictions: [ '#page' ]
})

browserSync.init( bsOptions )
