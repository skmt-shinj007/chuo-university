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
        response = res;
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

  async getProfileLink() {
    let link = config.twitter.baseUrl;
    const response = await this.getResponse('api/twitter/account');

    if (global.getType(response.data) === 'object') {
      link = response.data.link;
    }
    else {
      console.error('Error: 想定したデータ型で返却されませんでした。');
    }

    return link;
  },

  async getServiceInfo() {
    let info = config.twitter;
    const response = await this.getResponse('api/twitter/account');

    if (global.getType(response.data) !== 'object') return;
    info['link'] = response.data.link;

    return info;
  },
}
