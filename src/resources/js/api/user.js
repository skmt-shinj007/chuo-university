/**
 * User Data Api
 * ユーザーデータ取得APIの処理を記述します。
 */
import index from './index';
import viewData from '../config/data/viewData';

export default {
  /**
   * 選手取得
   * @param {function} setCallback 任意のオブジェクトに代入する処理
   */
  async getPlayer(setCallback) {
    const response = await index.getResponse('/player');
    let players = (Array.isArray(response.data)) ? response.data : [];
    setCallback(players);
  },

  /**
   * スタッフ取得
   * @param {function} setCallback 任意のオブジェクトに代入する処理
   */
  async getStaff(setCallback) {
    const response = await index.getResponse('/staff');
    let staff = (Array.isArray(response.data)) ? response.data : [];
    setCallback(staff);
  },

  /**
   * OB取得
   * @param {function} setCallback 任意のオブジェクトに代入する処理
   */
  async getAlumni(setCallback) {
    const response = await index.getResponse('/ob');
    let alumni = (Array.isArray(response.data)) ? response.data : [];
    setCallback(alumni);
  },

  /**
   * 白門会役員取得
   * @param {function} setCallback 任意のオブジェクトに代入する処理
   */
  async getOfficer(setCallback) {
    const response = await index.getResponse('/ob');
    const alumni = (Array.isArray(response.data)) ? response.data : [];
    const officerTagsId = Object.values(viewData.officerTags);

    const officers = alumni.filter(el => {
      return el.tags.find(tag => officerTagsId.includes(tag.tag_id));
    });
    setCallback(officers);
  },

  /**
   * 活躍中OB取得
   * @param {function} setCallback 任意のオブジェクトに代入する処理
   */
  async getActiveOb(setCallback) {
    const response = await index.getResponse('/active_ob');
    let activeAlumni = (Array.isArray(response.data)) ? response.data : [];
    setCallback(activeAlumni);
  },
}
