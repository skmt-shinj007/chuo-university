import index from './index';
import viewData from '../config/data/viewData';

export default {
  /**
   * provider取得
   * @param {function} setCallback 任意のオブジェクトに代入する処理
   */
  async getProvider(setCallback) {
    const res = await index.getResponse('/twitter/provider');
    const providers = (Array.isArray(res)) ? res : [];
    setCallback(providers);
  },

  /**
   * タイムライン取得
   * @param {function} setCallback 任意のオブジェクトに代入する処理
   */
  async getTimeline(setCallback) {
    const res = await index.getResponse('/twitter/timeline');
    const providers = (Array.isArray(res.data)) ? res.data : [];
    setCallback(providers);
  }
}
