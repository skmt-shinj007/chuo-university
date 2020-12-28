import Vue from 'vue';
import router from './router';  // vueルーターをインポート

/**
 * laravel-mix-svg-vue (svgファイルをVueコンポーネントとして使えるようにするライブラリ)
 */
import SvgVue from 'svg-vue';  // laravel-mix-svg-vueのインポート
Vue.use(SvgVue);

/**
 * swiper (global mount)
 */
import VueAwesomeSwiper from 'vue-awesome-swiper';
import 'swiper/css/swiper.css';  // swiper ~version5.x
Vue.use(VueAwesomeSwiper);

/**
 * global methods (全コンポーネントで使うオプション)
 */
import global from './config/global';
Vue.mixin(global);

/**
 * components (全ページで使う共通コンポーネント)
 */
import HeaderComponent from './components/layouts/HeaderComponent';
import FooterComponent from './components/layouts/FooterComponent';

new Vue({
    el: '#app',
    router: router,
    components: {
        HeaderComponent,
        FooterComponent
    },
});
