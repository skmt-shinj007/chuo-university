/**
 * 全コンポーネントで読み込むオプションを定義
 */

// メッセージを格納するJSONファイルをインポート
import Messages from './messages.json';

export default {
  data() {
    return {
      messages: Messages,
      /**
       * [ブレイクポイント]
       * @type { Number }
       */
      breakpointPc: 1025,

      /**
       * [現在のデバイス幅]
       * @type { Number }
       */
      windowWidth: 0,
      windowHeight: 0,

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

  created() {
    /**
     * [ウインドウサイズ取得]
     * 処理をリサイズイベントに登録する
     * @type { function }
     */
    this.handleResize();
    window.addEventListener('resize', this.handleResize);
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
    window.removeEventListener('resize', this.handleResize);
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
     * [windowサイズを取得]
     * イベント解除を考えて、メソッドとして登録
     */
    handleResize() {
      this.windowWidth = window.innerWidth;
      this.windowHeight = window.innerHeight;
    },

    /**
     * スクロールアニメーション
     * @param2 {el} ディレクティブを指定した要素のDOMが入る。
     */
    handleScroll(evt, el) {
      // アニメーションの
      let top = el.getBoundingClientRect().top;
      let trigger = this.windowHeight / 2;

      if (top < trigger) {
        el.setAttribute(
          'style',
          'opacity: 1; transform: translate3d(0, -10px, 0)'
        )
      }
    }
  },
}
