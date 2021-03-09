/**
 * 全コンポーネントで読み込むオプションを定義
 */

// サイト内で使用するテキスト群
import Messages from './messages.json';

export default {
  data() {
    return {
      messages: Messages,

      /**
       * [現在のスクロール量]
       * @type { Number }
       */
      scrollY: null,

      /**
     * [ユーザーカテゴリー情報]
     * 1. 選手
     * 2. スタッフ
     * 3. OB（役職あり）
     * 4. 現役OB（活躍中）
     * 5. OB
     */
      playerNum: 1,
      staffNum: 2,
      officerNum: 3,
      activeAlumniNum: 4,
      alumniNum: 5
    }
  },

  mounted() {
    /**
     * [スクロール量をリアルタイムで取得]
     * @type { function }
     */
    this.getScroll();
    window.addEventListener('scroll', this.getScroll);
  },

  beforeDestroy() {
    // コンポーネント破棄直前に追加したイベントをリスナーから削除
    window.removeEventListener('scroll', this.getScroll);
  },

  methods: {
    /**
     * [スクロール量を取得]
     * イベント解除を考えて、メソッドとして登録
     * https://gray-code.com/javascript/unset-event-listener/
    */
    getScroll() {
      this.scrollY = window.scrollY;
    },

    /**
     * スクロールアニメーション
     * @param2 {el} ディレクティブを指定した要素のDOMが入る。
     */
    fadeUp(evt, el) {
      // アニメーションの
      let top = el.getBoundingClientRect().top;
      let trigger = this.windowHeight / 2;

      if (top < trigger) {
        el.setAttribute(
          'style',
          'opacity: 1; transform: translate3d(0, -10px, 0);'
        )
      }
    }
  },
}
