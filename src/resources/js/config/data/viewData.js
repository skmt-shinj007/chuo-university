/**
 * サイト内で使用するコンテンツのデータを定義します。
 * @exports {Object} viewData
 */
import messages from '../messages.json';
const viewData = {

  about: [
    {
      title: messages.SectionTitles.Team,
      img: { src: "group01_2017", alt: "2017年東都春季リーグ戦" },
      button: messages.Links.Member,
      text: messages.about.team,
    },
    {
      title: messages.SectionTitles.Hakumonkai,
      img: { src: "hakumon01", alt: "中央大学多摩キャンパス白門" },
      button: messages.Links.Hakumonkai,
      text: messages.about.hakumonkai,
    },
    {
      title: messages.SectionTitles.Result,
      img: { src: "group01_2018", alt: "2018年東都春季リーグ" },
      button: messages.Links.TournamentResult,
      text: messages.about.result,
    },
    {
      title: messages.SectionTitles.Activity,
      img: { src: "activity", alt: "中央大学ソフトテニスコート" },
      button: messages.Links.Activity,
      text: messages.about.activity,
    },
    {
      title: messages.SectionTitles.Photo,
      img: { src: "group01_2019", alt: "2019春合宿" },
      button: messages.Links.Photo,
      text: messages.about.photo,
    }
  ],

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
  },
}
export default viewData;
