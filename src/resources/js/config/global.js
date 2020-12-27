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

  methods: {
    /**
     * DOMに記載した id属性をjsで一括取得できるメソッド
     * 参考：https://infoteck-life.com/a0186-js-dom-id-multiple/
     * @param data : 属性の名前が格納された配列
     * コンポーネントでのid取得方法：this.getElements(配列);
     * 複数取得した属性の要素一つにアクセスする場合、キー表記でアクセスが可能 -> this.ids['id名']
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

    /**
     * DOMに記載した class属性をjsで一括取得できるメソッド
     * 参考：https://infoteck-life.com/a0186-js-dom-id-multiple/
     * @param data : 属性の名前が格納された配列
     * コンポーネントでのclass取得方法：this.getClasses(配列);
     * 複数取得した属性の要素一つにアクセスする場合、キー表記でアクセスが可能 -> this.classes['class名']
     */
    getClasses(data) {
      let classes = [];
      let el = '';

      data.forEach(element => {
        el = document.getElementsByClassName(element);
        (el != null) ? classes[element] = el : null;
      })

      return classes;
    },
  },
}
