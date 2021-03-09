/**
 * [スクロール量取得処理]
 * 使用箇所でmixin登録する。
 */

export default {
  data() {
    return {
      /**
       * [現在のスクロール量]
       * @type { Number }
       */
      scrollY: null,
    }
  },

  created() {
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
  },
}
