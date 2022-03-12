const cssnano = require('cssnano')
const easyImport = require('postcss-easy-import')
const autoprefixer = require('autoprefixer')
const mqpacker = require('css-mqpacker')

module.exports = {
  plugins: [

    // To inline @import rules content
    // with extra features.
    easyImport({
      partial: true,
      extensions: ['.scss', '.css'],
      glob: true,
    }),

    // To packing same CSS
    // media query rules into one
    mqpacker(),

    // To parse CSS and add vendor prefixes to CSS rules using
    // values from `Can I Use`. It is recommended by Google and
    // used in Twitter and Alibaba.
    autoprefixer(),

    // For production
    cssnano(),

  ]
}
