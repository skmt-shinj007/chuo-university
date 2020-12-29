const mix = require('laravel-mix');
const VueLoader = require('vue-loader');

// svgファイルをvueコンポーネントとして使うために追加。
require('laravel-mix-svg-vue');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        extractVueStyles: true,

        // Vueコンポーネント内で sass変数,mixin を使用するために拡張
        globalVueStyles: 'resources/sass/_imports.scss',
    })
    .sourceMaps(false)
    .svgVue({
        // svgディレクトリのパスを記述
        svgPath: 'public/svg',
    })
    .version();
