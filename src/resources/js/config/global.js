/**
 * 全コンポーネントで読み込むオプションを定義
 */

// メッセージを格納するJSONファイルをインポート
import Messages from './messages.json';

export default {
  data() {
    return {
      messages: Messages,
      tabletWidth: 560,
      pcWidth: 992,
      windowWidth: null,
      scrollAmount: null,
    }
  },

  created() {
    // ウインドウ幅を取得
    this.windowWidth = window.innerWidth;
    window.addEventListener('resize', () => {
      this.windowWidth = window.innerWidth;
    });
  },

  mounted() {
    // スクロール量を取得
    this.scrollAmount = window.scrollY;
    window.addEventListener('scroll', () => {
      this.scrollAmount = window.scrollY;
    });
  },

  beforeDestroy() {
    // コンポーネント破棄直前に追加したイベントをリスナーから削除
    window.removeEventListener('resize', () => {
      this.windowWidth = window.innerWidth;
    });
    window.removeEventListener('scroll', () => {
      this.scrollAmount = window.scrollY;
    });
  },

  /**
   * グローバルで使用するメソッドを定義
   * コンポーネントからのアクセス：this.getElements()
   * 参考：https://infoteck-life.com/a0186-js-dom-id-multiple/
   */
  methods: {
    getElements() {
      let elm = {};
      let elements = {};  // 一括でidを取得したデータが格納される:Object
      let id = '';        // id名が入る:String

      for (let i = 0; i < arguments.length; i++) {
        id = arguments[i];
        elm = document.getElementById(id);

        if (elm != null) {
          elements[id] = elm;
        }
      }

      return elements;
    }
  },
}
