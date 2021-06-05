/**
 * 全コンポーネントで読み込むオプションを定義
 */

// サイト内で使用するテキスト群
import Messages from './messages.json';

export default {
  data() {
    return {
      messages: Messages,

      // Api responseに切り替えた時点で削除
      officerNum: 3,
    }
  },

  methods: {
    /**
     * データ型を文字列で返す。
     * @param {*} target
     * @returns {string}
     */
    getType(target) {
      return toString.call(target).slice(8, -1).toLowerCase();
    },

    /**
     * 現在のページをリロード。
     */
    reload() {
      this.$router.go({
        path: this.$router.currentRoute.path,
        force: true,
      })
    },

    /**
     * 外部サイトに別タブで遷移させる。
     * 脆弱性に対応するため、noopenerとnoreferrerを付与する。
     * @param {string} url
     */
    externalLink(url) {
      const option = 'noopener, noreferrer';
      window.open(url, '_blank', option);
    },

    /**
     * テーブルのレコードを描画する配列要素を生成。
     * @param {Str or Num} key テーブルの左列に入る値
     * @param {Str or Num} value テーブルの右列に入る値
     * @return {Object} レコードの要素
     */
    createTableBody(key, value) {
      return {
        key: key,
        value: value,
      };
    },

    /**
     * TableComponent.vueに渡すデータ構造に整える。
     * @param {String} title テーブルのタイトル
     * @param {Array} body テーブルのレコード
     * @return {Object} テーブルコンポーネントに渡すデータ
     */
    createTableData(title, body) {
      let data = {};
      data['title'] = title;
      data['body'] = body;
      return data;
    },
  },
}
