/**
 * サイト内で使用するコンテンツのデータを定義します。
 * @exports {Object} viewData
 */
const viewData = {

  officersTableColumn: [
    { id: 1, prop: 'main_officer_tag_name', label: "白門会役職" },
    { id: 2, prop: 'name_ja', label: "名前" },
    { id: 3, prop: 'graduate_date_str', label: "卒業年" }
  ],

  staffTags: {
    honorary_president: 14,
    councilor: 15,
    chairman: 16,
    vice_president: 17,
    chief: 18,
  },

  officerTags: {
    honorary_president: 14,
    councilor: 15,
    chairman: 16,
    vice_president: 17,
    chief: 18,
    vice_chief: 19,
    executive_director: 20,
    director: 21,
    auditor: 22,
    counsellor: 23
  }
}
export default viewData;
