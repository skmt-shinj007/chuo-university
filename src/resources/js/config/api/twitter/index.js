import axios from 'axios';
import config from '../../config.json';
import global from '../../global';

/**
 * 環境判定  @type { Boolean }
 * [本番]false
 * [開発]true
 */
const debug = !process.env.MIX_PRODUCTION;

export default {
  async getResponse(url) {
    let response = null;

    await axios.get(url)
      .then(function (res) {
        response = res.data;
      })

      .catch(function (err) {
        if (debug) {
          console.log(err);
          console.log(`エラーメッセージ：${err.message}`);
          console.log(err.response);
        }
        // TODO:エラーページへリダイレクト

        return response;
      });

    return response;
  },
}
