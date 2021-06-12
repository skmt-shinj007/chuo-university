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

  concepts: [
    {
      id: 1,
      title: { ja: "目標", en: "target" },
      keyword: messages.concept.keyword.target,
      content: messages.concept.text.target,
    },
    {
      id: 2,
      title: { ja: "目的", en: "mission" },
      keyword: messages.concept.keyword.mission,
      content: messages.concept.text.mission,
    },
    {
      id: 3,
      title: { ja: "部訓", en: "symbol" },
      keyword: messages.concept.keyword.symbol,
      content: messages.concept.text.symbol,
    },
  ],

  practiceTable: {
    title: null,
    body: [
      { key: "練習時間", value: "9:00 ~ 12:00（全体練習）"},
      { key: "活動期間", value: "2月 - 8月、9月 - 12月" },
      { key: "オフ",    value: "毎週月曜日・各大会後" },
      { key: "練習場所", value: "〒192-0393\n東京都八王子市東中野742-1\n中央大学多摩キャンパス第二体育館ソフトテニスコート" }
    ]
  },

  scheduleTable: {
    title: messages.tableTitle.schedule,
    body: [
      { key: "1月",  value: "オフ" },
      { key: "2月",  value: "オフ / 練習開始" },
      { key: "3月",  value: "春合宿" },
      { key: "4月",  value: "東都リーグ（春）" },
      { key: "5月",  value: "関東リーグ（春）" },
      { key: "6月",  value: "定期戦（立命館大学）" },
      { key: "7月",  value: "東日本インカレ" },
      { key: "8月",  value: "インカレ" },
      { key: "9月",  value: "東都リーグ（秋）" },
      { key: "10月", value: "関東リーグ（秋）" },
      { key: "11月", value: "大学対抗" },
      { key: "12月", value: "オフ / 納会"}
    ]
  },

  dormitory: [
    {
      icon: { src: "dining", alt: "レストランのアイコン" },
      text: messages.dormitoryText.restaurant,
      attributes: []
    },
    {
      icon: { src: "bath", alt: "お風呂のアイコン" },
      text: messages.dormitoryText.bath,
      attributes: [ "朝：6:00 - 9:30", "昼：12:00 - 14:00", "夜：16:30 - 23:00" ],
    },
    {
      icon: { src: "hotel", alt: "ベッドのアイコン" },
      text: messages.dormitoryText.room,
      attributes: [],
    },
    {
      icon: { src: "laundry", alt: "洗濯機のアイコン" },
      text: messages.dormitoryText.laundry,
      attributes: [ "洗濯機：無料", "乾燥機：24分 / 100円" ],
    }
  ],

  homeCourt: [
    {
      src    : "court05.jpg",
      alt    : "中央大学多摩キャンパスソフトテニスコート",
      caption: "多摩校舎ソフトテニスコート（第二体育館）"
    },
    {
      src    : "court03.jpg",
      alt    : "中央大学多摩キャンパスソフトテニスコート",
      caption: "ソフトテニスコート（1,2,3）"
    },
    {
      src    : "court04.jpg",
      alt    : "中央大学多摩キャンパスソフトテニスコート",
      caption: "ソフトテニスコート（4,5,6）"
    }
  ],

  roomImages: [
    { src: "room01.jpg", alt: "中央大学南平寮", caption: 4 },
    { src: "room02.jpg", alt: "中央大学南平寮", caption: 4 },
    { src: "room03.jpg", alt: "中央大学南平寮", caption: 3 }
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

  achievementsTable: {
    title: null,
    body: [
      { key: "全日本大学対抗戦", value: 8 },
      { key: "東日本大学対抗戦", value: 11 },
      { key: "全日本大学王座決定戦", value: 4 },
      { key: "全日本学生選手権", value: 4 },
    ]
  },

  champions: [
    {
      player1: { name_ja: "岩佐 正治", belong: "東京", isOB: true },
      player2: { name_ja: "石川 長一", belong: "東京", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "昭和23年" },
          { key: "日付", value: "8/28-29" },
          { key: "場所", value: "名古屋" }
        ]
      }
    },
    {
      player1: { name_ja: "岩佐 正治", belong: "東京", isOB: true },
      player2: { name_ja: "安友 省三", belong: "東京", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "昭和24年" },
          { key: "日付", value: "8/27-28" },
          { key: "場所", value: "東京後楽園コート" }
        ]
      }
    },
    {
      player1: { name_ja: "石川 恵脩", belong: "東京", isOB: true },
      player2: { name_ja: "右近 義信", belong: "東京", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "昭和42年" },
          { key: "日付", value: "8/12-13" },
          { key: "場所", value: "伊勢市" }
        ]
      }
    },
    {
      player1: { name_ja: "竹島 満", belong: "山口", isOB: true },
      player2: { name_ja: "小林 元治", belong: "東京", isOB: true },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "昭和45年" },
          { key: "日付", value: "8/21-23" },
          { key: "場所", value: "いわき市" }
        ]
      }
    },
    {
      player1: { name_ja: "中堀 成生", belong: "広島", isOB: true },
      player2: { name_ja: "高川 経生", belong: "広島", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "平成7年" },
          { key: "日付", value: "9/29 - 10/30" },
          { key: "場所", value: "浜松市" }
        ]
      }
    },
    {
      player1: { name_ja: "中堀 成生", belong: "広島", isOB: true },
      player2: { name_ja: "高川 経生", belong: "広島", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "平成8年" },
          { key: "日付", value: "9/27-29" },
          { key: "場所", value: "川口市" }
        ]
      }
    },
    {
      player1: { name_ja: "中堀 成生", belong: "広島", isOB: true },
      player2: { name_ja: "高川 経生", belong: "広島", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "平成9年" },
          { key: "日付", value: "9/26-28" },
          { key: "場所", value: "鈴鹿市" }
        ]
      }
    },
    {
      player1: { name_ja: "中堀 成生", belong: "広島", isOB: true },
      player2: { name_ja: "高川 経生", belong: "広島", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "平成11年" },
          { key: "日付", value: "9/21-24" },
          { key: "場所", value: "佐賀市" }
        ]
      }
    },
    {
      player1: { name_ja: "中堀 成生", belong: "広島", isOB: true },
      player2: { name_ja: "高川 経生", belong: "広島", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "平成13年" },
          { key: "日付", value: "9/21-23" },
          { key: "場所", value: "松山市" }
        ]
      }
    },
    {
      player1: { name_ja: "中堀 成生", belong: "広島", isOB: true },
      player2: { name_ja: "高川 経生", belong: "広島", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "平成17年" },
          { key: "日付", value: "9/23-25" },
          { key: "場所", value: "厚木市" }
        ]
      }
    },
    {
      player1: { name_ja: "中堀 成生", belong: "広島", isOB: true },
      player2: { name_ja: "高川 経生", belong: "広島", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "平成18年" },
          { key: "日付", value: "10/20-25" },
          { key: "場所", value: "福岡市" }
        ]
      }
    },
    {
      player1: { name_ja: "中堀 成生", belong: "広島", isOB: true },
      player2: { name_ja: "高川 経生", belong: "広島", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "平成21年" },
          { key: "日付", value: "10/16-18" },
          { key: "場所", value: "三木市" }
        ]
      }
    },
    {
      player1: { name_ja: "中堀 成生", belong: "広島", isOB: true },
      player2: { name_ja: "高川 経生", belong: "広島", isOB: false },
      table: {
        title: messages.tableTitle.tournamentInformation,
        body: [
          { key: "年度", value: "平成22年" },
          { key: "日付", value: "10/15-17" },
          { key: "場所", value: "徳島市" }
        ]
      }
    },
  ],

  imageFilterTable: {
    title: messages.filters.name,
    body: [
      {
        key: messages.year.name.ja,
        value: {
          name: messages.year.name.en,
          menus: [],
        }
      },
    ]
  }

}
export default viewData;
