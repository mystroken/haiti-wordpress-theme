// import sass from 'node-sass'
import {terser} from 'rollup-plugin-terser'
import resolve from 'rollup-plugin-node-resolve'
import commonjs from 'rollup-plugin-commonjs'
import babel from 'rollup-plugin-babel'
import del from 'rollup-plugin-delete'
import hmr from 'rollup-plugin-hot'
import postcss from 'rollup-plugin-postcss-hot'

// Since we use nollup for dev and rollup for build,
// We could assume that prod is the abscense of nollup
const production = process.env.NODE_ENV === 'production'
const format = process.env.NOLLUP ? 'esm' : 'iife'

// Hot Module Replacement (HMR) exchanges,
// adds, or removes modules while an application
// is running, without a full reload.
const hot = hmr({
  enabled: !production,
  public: './assets/dist/',
  clearConsole: false,
  inMemory: true,
  open: 'default',
  openPort: 5000,
})




export default [
  {
    input: './assets/src/js/app.js',
    output: {
      format,
      sourcemap: !production,
      file: './assets/dist/js/app.js',
    },
    // our example contains dynamic imports (because we want to test them with
    // HMR!), so we need this option to be able to build to an iife
    inlineDynamicImports: true,
    plugins: [
      // Delete files and folders using Rollup.
      production && del({ targets: './assets/dist/*' }),
      // support modules from node_modules.
      resolve(),
      // support of require.
      commonjs({ include: 'node_modules/**' }),
      // Babel converts ECMAScript 2015+ code into
      // a backwards compatible version of JavaScript in current
      // and older browsers or environments.
      babel(),
      // Hot Module Replacement (HMR) exchanges,
      // adds, or removes modules while an application
      // is running, without a full reload.
      hot,
      // A JavaScript parser and
      // mangler/compressor toolkit for ES6+.
      production && terser(),
    ],

    watch: { clearScreen: false },
  },

  // // postcss
  {
    input: './assets/src/postcss/style.js',
    output: {
      sourcemap: !production,
      format,
      file: './assets/dist/css/style.js',
    },
    plugins: [
      // PostCss should be used before commonjs
      // Or it will try to interpret the content of CSS
      // file as JavaScript.
      postcss({
        hot: !production,
        sourceMap: !production,
        extract: 'style.css',
        extensions: ['.scss', '.css'],
        loaders: ['sass'],
      }),
      hot
    ],
    watch: { clearScreen: false },
  },

  // // postcss
  {
    input: './assets/src/postcss/woocommerce.js',
    output: {
      sourcemap: !production,
      format,
      file: './assets/dist/css/woocommerce.js',
    },
    plugins: [
      // PostCss should be used before commonjs
      // Or it will try to interpret the content of CSS
      // file as JavaScript.
      postcss({
        hot: !production,
        sourceMap: !production,
        extract: 'woocommerce.css',
        extensions: ['.scss', '.css'],
        loaders: ['sass'],
      }),
      hot
    ],
    watch: { clearScreen: false },
  },
]
