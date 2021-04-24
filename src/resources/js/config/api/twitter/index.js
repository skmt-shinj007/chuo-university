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

  async generationLink() {
    const baseUrl = config.twitter.baseUrl;
    let screenName = '';
    const response = await this.getResponse('api/twitter/account');

    if (global.isStringEmpty(screenName)) {
      screenName = response.data.screen_name;
    }
    else {
      return baseUrl;
    }

    return baseUrl + screenName;
  },

  async getAccount() {
    const response = await this.getResponse('api/twitter/account');
    console.log(response);
  }

}
