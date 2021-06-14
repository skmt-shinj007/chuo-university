import axios from 'axios';

/**
 * 環境判定  @type { Boolean }
 * [本番]:false
 * [開発]:true
 */
const debug = !process.env.PRODUCTION;

export default {
  /**
   * APIレスポンス取得
   * @param {string} endPoint
   * @returns response
   */
  async getResponse(endPoint) {
    let response = null;

    await axios.get(`/api${endPoint}`)
      .then(function (res) {
        response = res.data;
      })

      .catch(function (err) {
        console.log(err.message);
        if (debug) {
          console.log(err);
          console.log(err.response);
        }
        // TODO:エラーページへリダイレクト

        return response;
      });

    return response;
  },
}
