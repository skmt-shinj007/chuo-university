/**
 * アニメーション関連のmixinファイル
 * アニメーションを使用するコンポーネントでこのファイルをmixin登録する。
 */

// mixin
import Resize from './resize';

export default {
  mixins: [Resize],

  methods: {
    /**
     * 下から浮き上がるアニメーション
     * v-scrollディレクティブ使用要素にメソッド名に対応したクラスをつける。
     * @param2 {el} ディレクティブを指定した要素のDOMが入る。
     */
    fadeUp(evt, el) {
      let top = el.getBoundingClientRect().top;
      let trigger = this.windowHeight / 2;

      if (top < trigger) {
        el.setAttribute(
          'style',
          'opacity: 1; transform: translate3d(0, -10px, 0);'
        )
      }
    },

    fade(evt, el) {
      let top = el.getBoundingClientRect().top;
      let trigger = this.windowHeight / 2;

      if (top < trigger) {
        el.setAttribute(
          'style',
          'opacity: 1;'
        )
      }
    }
  },
}
