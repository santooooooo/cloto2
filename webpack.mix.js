const mix = require('laravel-mix');
require('laravel-mix-alias');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
  devServer: {
    proxy: {
      '*': 'http://localhost:8000',
    },
  },
});

mix.alias({
  '@': '/resources/js',
  '~': '/resources/sass',
});

mix
  .js('resources/js/app.js', 'public/js')
  .js('resources/js/admin/app.js', 'public/js/admin')
  .copy('node_modules/please-wait/build/please-wait.min.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .copy('node_modules/please-wait/build/please-wait.css', 'public/css')
  .copy('node_modules/spinkit/spinkit.min.css', 'public/css')
  .sourceMaps();

if (mix.inProduction()) {
  mix.version();
}
