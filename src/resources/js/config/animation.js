/**
 * アニメーション関連のmixinファイル
 * アニメーションを使用するコンポーネントでこのファイルをmixin登録する。
 */

import Resize from './resize';

export default {
  mixins: [Resize],

  data() {
    return {
      /**
       * アニメーションの方向
       */
      dir: {
        up: 'fadeUp',
        right: 'fadeRight',
        down: 'fadeDown',
        left: 'fadeLeft'
      }
    }
  },

  methods: {
    /**
     * v-scrollディレクティブ使用要素にメソッド名に対応したクラスをつける。
     * @param2 {el} ディレクティブを指定した要素のDOMが入る。
     */
    fade(evt, el) {
      let top = el.getBoundingClientRect().top;
      let trigger = this.windowHeight / 2;

      if (top < trigger) {
        el.setAttribute(
          'style',
          'opacity: 1;'
        )
      }
    },
  },
}
