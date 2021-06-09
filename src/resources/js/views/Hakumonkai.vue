<template>
<div class="hakumonkai">
  <section class="hakumonkai__header">
    <contents-title :title="messages.SectionTitles.Hakumonkai"/>
    <div class="lead__text-wrap">
      <p class="lead__text nl2br" v-text="messages.Hakumonkai.Lead"></p>
    </div>
  </section>

  <div class="background-prlx" v-prlx.background="{ speed: 0.3 }"/>

  <section class="hakumonkai__officer" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.Officer"/>
    <tile-table :columns="viewData.officersTableColumn" :columnBodies="officersForTable"/>
  </section>

  <section class="hakumonkai__active fade" v-scroll="fade">
    <contents-title :title="messages.SectionTitles.ActiveAlumni"/>
    <player-slider :players="users.activeAlumni" color="darkblue"/>
  </section>

  <section class="hakumonkai__message" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.Message"/>
    <div class="message__content">
      <p class="message__text nl2br" v-text="messages.Hakumonkai.Message"/>
    </div>
    <div class="message__button">
      <link-button :link="messages.Links.ToContact"/>
    </div>
  </section>

  <div class="hakumonkai__scroll-top">
    <scroll-top-button/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import TileTable from '../components/modules/table/TileTableComponent';
import PlayerCard from '../components/modules/card/PlayerCardComponent';
import LinkButton from '../components/modules/button/LinkButtonComponent';
import PlayerSlider from '../components/modules/slider/PlayerSliderComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';

// config
import Animation from '../config/animation';
import Mock from '../config/data/mock.json';
import Api from '../config/api/index';
import ViewData from '../config/data/viewData';

export default {
  components: {
    ContentsTitle,
    TileTable,
    PlayerCard,
    LinkButton,
    PlayerSlider,
    ScrollTopButton,
  },

  mixins: [Animation],

  data() {
    return {
      mock: Mock,
      viewData: ViewData,

      users: {
        officers: [],
        activeAlumni: [],
      },
    }
  },

  computed: {
    /**
     * テーブル表示用にレスポンスをカスタムする
     * @return {Array} officers テーブル表示用にカスタマイズされたuserレスポンス
     */
    officersForTable() {
      let officers = [];
      const officerTagsId = Object.values(this.$data.viewData.officerTags);

      this.users.officers.forEach(alumnus => {
        officers.push(this.customResponseForTable(alumnus, officerTagsId));
      });

      // 役員順に並び替え
      officers.sort((filst, second) => {
        if (filst.sortNumber < second.sortNumber) return -1;
        if (filst.sortNumber > second.sortNumber) return 1;
        return 0;
      });

      return officers;
    },
  },

  created() {
    const viewData = this.$data.viewData;
    const officerTagsId = Object.values(viewData.officerTags);

    Api.getResponse('/active_ob').then(res => {
      const data = res.data;
      if (this.getType(data) === 'array') {
        this.users.activeAlumni = data;
      }
      else {
        new Error('active ob response :レスポンスが配列ではありません。');
      }
    });

    Api.getResponse('/ob').then(res => {
      const data = res.data;
      // dataが配列であることを保証する
      if (this.getType(data) !== 'array') new Error('ob officer response :レスポンスが配列ではありません。');
      // 役員持ちのOBを抽出
      const officers = data.filter(el => {
        return el.tags.find(tag => officerTagsId.includes(tag.tag_id));
      });
      this.users.officers = officers;
    });
  },

  methods: {
    /**
     * テーブルデータのプロパティを取得
     * @param {Array} tableData テーブルのコンテンツ情報
     * @param {Number} id 要素のプロパティ値を返す id を指定する。
     * @return {String} propName idに一致したpropキーの値
     */
    pickupTableColumnProp(tableData, id) {
      let propName = null;
      tableData.forEach(el => {
        if (el.id === id) {
          propName = el.prop;
        }
      });
      return propName;
    },

    /**
     * userレスポンスにテーブル表示に必要なプロパティを追加する
     * @param {Object} user userオブジェクト
     * @param {Array} tagIds 検索する配列
     * @param {String} propName userオブジェクトに追加するプロパティ名
     * @return {Object} user object
     */
    customResponseForTable(user, tagIds) {
      const tagCloumnProp = this.pickupTableColumnProp(this.$data.viewData.officersTableColumn, 1);

      // 並び替えに必要なtag_idと役員名をレスポンスの第一階層に追加する。
      user.tags.forEach(tag => {
        if (tagIds.includes(tag.tag_id)) {
          user[tagCloumnProp] = tag.name_ja;
          user['sortNumber'] = tag.tag_id;
        }
      });

      user['graduate_date_str'] = `${user.graduate_date}年卒`;
      return user;
    }
  },
}
</script>

<style lang="scss" scoped>
.hakumonkai {

  &__header {
    margin-top: interval(5);
  }

  &__officer {
    margin-top: interval(5);
  }

  &__players {
    @include flex(column wrap, center, center);

    @include mq(sm) {
      @include flex(row nowrap, flex-start, stretch);
    }
  }

  &__scroll-top {
    @include scroll-top();
  }
}

.background-prlx {
  @include background-image('/image/hakumon03.jpg', center top);
  width: 100%;
  height: interval(30);
}

.lead {
  &__text-wrap {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin: 0 auto interval(5) auto;
    }
  }

  &__text {
    font-weight: bold;
    text-align: center;

    @include mq(sm) {
      max-width: interval(80);
      margin: 0 auto;
    }
  }
}

.message {
  &__content {
    margin-bottom: interval(5);
  }

  &__text {
    text-align: center;
    font-weight: bold;
  }

  &__button {
    @include mq(sm) {
      max-width: interval(50);
      margin: 0 auto;
    }
  }
}
</style>
