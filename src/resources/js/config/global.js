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
      breakPointTablet: 560,
      breakpointPc: 992,

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
    window.addEventListener('resize', () => {
      this.windowWidth = window.innerWidth;
    });
  },

  mounted() {
    /**
     * [スクロール量をリアルタイムで取得]
     * @type { function }
     */
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
     * [id属性をjsで一括取得]
     * キー表記でアクセスすることで element が取得可能 => this.ids['id名']
     * @param data : 属性の名前が格納された配列
     * @returns { object } : 取得した要素のHTMLCollectionが格納された配列で戻る
     * @link { https://infoteck-life.com/a0186-js-dom-id-multiple/ }
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
     * [class属性をjsで一括取得]
     * 複数取得した属性の要素一つにアクセスする場合、キー表記でアクセスが可能 -> this.classes['class名']
     * @param data : 属性の名前が格納された配列
     * @return { object } : 取得した要素のHTMLCollectionが格納された配列で戻る
     * @link { https://infoteck-life.com/a0186-js-dom-id-multiple/ }
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

    /**
     * [要素の高さを一括取得できるメソッド]
     * ドット記法で要素にアクセス可能
     * @param data : 属性の名前が格納された配列
     * @return { Array } : 各要素の高さが入った配列を返す
     * ex) > [hoge: 23, fuga: 99]
     */
    getElementHeight(data, method = 'id') {
      let heights = [];
      let el = '';

      // class指定の場合こちらが通る
      if (method === 'class') {
        data.forEach(element => {
          el = document.getElementsByClassName(element).offsetHeight;
          (el != null) ? heights[element] = el : null;
        })
        return heights;
      }

      // idの場合こちらが通る（デフォルト）
      data.forEach(element => {
        el = document.getElementById(element).offsetHeight;
        (el != null) ? heights[element] = el : null;
      })
      return heights;
    }
  },
}
