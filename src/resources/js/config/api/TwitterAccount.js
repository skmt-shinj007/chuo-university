import axios from 'axios';
export default {
  data() {
    return {
      /**
       * twitterの情報オブジェクト
       */
      twitter: {},

      /**
       * ローディング判定
       * @type { Boolean }
       */
      loading: false,
    }
  },

  methods: {
    /**
     * Twitterアカウント情報を取得
     * @param { function } .finally()内で実行するプロセス共通処理
     */
    async getTwitterAccount(callback = this.void) {
      // ロード開始
      this.loading = true;

      await axios.get('/api/twitter/account')

      .then(function (response) {
        // リンクを作成
        const screenName = response.data.screen_name;
        const baseUrl = this.config.twitter.baseUrl;

        // Twitterオブジェクトにセット
        this.twitter = {
          ...this.twitter,
          link: baseUrl + screenName,
        }

      }.bind(this))

      .catch(function (err) {
        console.log(err);

        if (err.response) {
          console.log('Err Message:', err.response.data.message);
          console.log('Status Code:', err.response.status);
          console.log('Status Text:', err.response.statusText);
        }

        // Twitterオブジェクトにセット
        this.twitter = {
          ...this.twitter,
          link: this.config.twitter.baseUrl,
        }
      }.bind(this))

      .finally(function () {
        // 非同期処理が終わったらloadingフラグをfalseに変更。
        this.loading = false;
        callback();
      }.bind(this))

    },

    /**
     * 何もしない関数
     * getTwitterAccount関数のデフォルト引数で使用
     */
    void() {},

  },
}
