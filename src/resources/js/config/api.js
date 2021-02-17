// axios import
import axios from 'axios';

export default {
  data() {
    return {
      /**
       * twitter APIから取得した情報を格納
       */
      twitterResponse: null,
    }
  },

  mounted() {
    console.log(this.twitterResponse);

    axios.get('https://api.coindesk.com/v1/bpi/currentprice.json')
      .then(function (response) {
        // 通信に成功したときの処理
        console.log(response.data.bpi)
      }.bind(this))
      .catch(function (error) {
        // 通信に失敗した時の処理
        console.log(error)
      }
    )
  },
}
