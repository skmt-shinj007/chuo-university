import axios from 'axios';
export default {
  data() {
    return {
      /**
       * Twitterプロフィールへのリンク
       * @type { String }
       */
      toProfile: '',
    }
  },

  created() {

  },

  methods: {
    /**
     * Twitterアカウント情報を取得
     */
    async getAccount() {
      await axios.get('/api/twitter/account')

      .then(function (response) {
        /**
         * 情報を結合してTwitterのプロフィールへ飛ぶURLを作成する。
         */
        const screenName = response.data.screen_name;
        const baseUrl = this.config.twitter.url;

        this.toProfile = baseUrl + screenName;

      }.bind(this))

      .catch(function (err) {
        console.log(err);

        if (err.response) {
          console.log('Err Message:', err.response.data.message);
          console.log('Status Code:', err.response.status);
          console.log('Status Text:', err.response.statusText);
        }

        this.toProfile = baseUrl;
      }.bind(this))
    },
  },
}
