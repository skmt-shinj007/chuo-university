/**
 * 全コンポーネントで読み込むオプションを定義
 */

// メッセージを格納するJSONファイルをインポート
import Messages from './messages.json';

export default {
  data() {
    return {
      messages: Messages,
      windowWidth: window.innerWidth,
      tabletWidth: 560,
      pcWidth: 992,
    }
  },

  mounted() {
    window.addEventListener('resize', this.WindowWidthResize);
  },

  beforeDestroy() {
    window.removeEventListener('resize', this.WindowWidthResize);
  },

  methods: {
    WindowWidthResize() {
      this.windowWidth = window.innerWidth;
    },
  },
}
