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
 * vue-prlx
 * vueで簡単にパララックスを導入できるライブラリ
 */
import VuePrlx from 'vue-prlx';
Vue.use(VuePrlx);

/**
 * global methods (全コンポーネントで使うオプション)
 */
import global from './config/global';
Vue.mixin(global);

/**
 * axios import
 */
import axios from 'axios';
import vueAxios from 'vue-axios';
Vue.use(vueAxios, axios);

/**
 * スクロールアニメーションのカスタムディレクティブを作成。
 */
Vue.directive('scroll', {
  inserted: function (el, binding) {
    let f = function (evt) {
      if (binding.value(evt, el)) {
        window.removeEventListener('scroll', f)
      }
    }
    window.addEventListener('scroll', f)
  }
})

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

  /**
   * セキュリティ対策
   * DOMがマウントされた後に実行。
   * ! v-if等で生成された要素には適用されないので注意
   */
  mounted() {
    // サイト内のaタグを取得
    let anchorElementsObject = document.getElementsByTagName('a');
    // ビュー全体がレンダリングされた後にnoopenerを付与
    this.$nextTick(() => {
      this.addNoopener(anchorElementsObject);
    })
  },

  methods: {
    /**
     * [サイト内のaタグにnoopenerを付与する処理]
     * つけ忘れを防ぐために作成。
     * @param {object} el
     */
    addNoopener(el) {
      // HTMLCollection [Object] を配列に変換
      let anchorElements = Object.entries(el).map(([key, value]) => ({'key': key, 'value': value}))

      // 配列にした要素をループして target = "_blank" が設定されている要素を検出
      anchorElements.forEach(element => {
        // target='_blank' が設定されている要素に rel='noopener noreferrer'をつける
        if (element.value.getAttribute("target") === '_blank') {
          element.value.setAttribute("rel", "noopener noreferrer");
        }
      });
    }
  },
});
