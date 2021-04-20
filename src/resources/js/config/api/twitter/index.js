import axios from 'axios';

/**
 * 環境判定  @type { Boolean }
 * [本番]false
 * [開発]true
 */
const debug = !process.env.MIX_PRODUCTION;

export default {
  async getResponse(url) {
    let data = null;

    await axios.get(url)
      .then(function (res) {
        data = res;
      })

      .catch(function (err) {
        if (debug) {
          console.log(err);
          console.log(`エラーメッセージ：${err.message}`);
          console.log(err.response);
        }

        return data;
      });

    return data;
  },

}
