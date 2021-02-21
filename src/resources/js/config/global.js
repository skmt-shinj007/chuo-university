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
      windowWidth: null,

      /**
       * [現在のスクロール量]
       * @type { Number }
       */
      scrollAmount: null,

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
     * [ウインドウ幅をリアルタイムで取得]
     * @type { function }
     */
    this.windowWidth = window.innerWidth;
    window.addEventListener('resize', this.getWindowWidth);
  },

  mounted() {
    /**
     * [スクロール量をリアルタイムで取得]
     * @type { function }
     */
    this.scrollAmount = window.scrollY;
    window.addEventListener('scroll', this.getScroll);
  },

  beforeDestroy() {
    // コンポーネント破棄直前に追加したイベントをリスナーから削除
    window.removeEventListener('resize', this.getWindowWidth);
    window.removeEventListener('scroll', this.getScroll);
  },

  methods: {
    /**
     * [スクロール量を取得]
     * イベント解除を考えて、メソッドとして登録
     * https://gray-code.com/javascript/unset-event-listener/
    */
    getScroll() {
      this.scrollAmount = window.scrollY;
    },

    /**
     * [windowサイズを取得]
     * イベント解除を考えて、メソッドとして登録
     */
    getWindowWidth() {
      this.windowWidth = window.innerWidth;
    },

    /**
     * [id属性をjsで一括取得]
     * キー表記でアクセスすることで element が取得可能 => this.ids['id名']
     * @param data : 属性の名前が格納された配列
     * @returns { object } : 取得した要素のHTMLCollectionが格納された配列で戻る
     * @link { https://infoteck-life.com/a0186-js-dom-id-multiple/ }
     * !vueでは、ref属性から取得可能
     */
    getElements(data) {
      let elements = [];
      let el = '';

      data.forEach(element => {
        el = document.getElementById(element);
        (el != null) ? elements[element] = el : null;
      })

      return elements;
    },
  },
}
