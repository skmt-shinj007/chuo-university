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

  /**
   * 文字列に対する型チェックと空文字の判定
   * @param {String} target
   * @returns Boolean
   */
  isStringEmpty(target) {
    return ((typeof (target) === "string") || (target instanceof String) || (target !== ''))
  },

  getType(target) {
    return toString.call(target).slice(8, -1).toLowerCase();
  },
}
