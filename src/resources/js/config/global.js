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
     * 現在のページをリロード
     */
    reload() {
      this.$router.go({
        path: this.$router.currentRoute.path,
        force: true,
      })
    }
  },
}
