/**
 * [Windowリサイズに関する処理]
 * 使用したい箇所でmixin登録する。
 */

export default {
  data() {
    return {
      /**
       * [ブレイクポイント]
       * @type { Object }
       */
      breakpoints: {
        sm: 560,
        md: 1025,
      },

      /**
       * [現在のデバイス幅]
       * @type { Number }
       */
      windowWidth: 0,
      windowHeight: 0,
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

  beforeDestroy() {
    // コンポーネント破棄直前に追加したイベントをリスナーから削除
    window.removeEventListener('resize', this.handleResize);
  },

  methods: {
    /**
     * [windowサイズを取得]
     * イベント解除を考えて、メソッドとして登録
     */
    handleResize() {
      this.windowWidth = window.innerWidth;
      this.windowHeight = window.innerHeight;
    },
  },
}
