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
    <tile-table :columns="viewdata.officersTableColumn" :columnBodies="officersForTable"/>
  </section>

  <section class="hakumonkai__active fade" v-scroll="fade">
    <contents-title :title="messages.SectionTitles.ActiveAlumni"/>
    <div class="hakumonkai__player-slider">
      <slider :options="playerSliderOptions" :items="activeAlumni" color="darkblue">
        <template v-slot:slideContents="player">
          <user-card :user="player.item" @open="openCardModal"/>
        </template>
      </slider>
      <!-- modal -->
      <active-alumni-modal
        v-if="card.modal.isShow"
        @close="closeCardModal"
        :activeAlumni="card.modal.el"
        :labels="card.modal.labels"
      />
    </div>
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
import UserCard from '../components/modules/card/UserCardComponent';
import LinkButton from '../components/modules/button/LinkButtonComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';
import Slider from '../components/modules/slider/SliderComponent';
import ActiveAlumniModal from '../components/modules/modal/ActiveAlumniModal';

// config
import Animation from '../config/animation';
import Mock from '../config/data/mock.json';
import ViewData from '../config/data/viewdata';

export default {
  components: {
    ContentsTitle,
    TileTable,
    UserCard,
    LinkButton,
    ScrollTopButton,
    Slider,
    ActiveAlumniModal,
  },

  mixins: [Animation],

  data() {
    return {
      mock: Mock,
      viewdata: ViewData,

      // user card section data
      card: {
        modal: {
          isShow: false,
          el: null,
        },
      }
    }
  },

  computed: {
    // app.jsのUserAPIレスポンスを取りに行く。
    officers() {
      return this.$root.users.officers;
    },
    activeAlumni() {
      return this.$root.users.activeAlumni;
    },

    /**
     * テーブル表示用にレスポンスをカスタムする
     * @return {Array} officers テーブル表示用にカスタマイズされたuserレスポンス
     */
    officersForTable() {
      let officers = [];
      const officerTagsId = Object.values(this.$data.viewdata.officerTags);
      this.officers.forEach(alumnus => {
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

    /**
     * swiperのオプションを返す。
     * @return swiper option
     */
    playerSliderOptions() {
      return this.$data.viewdata.playerSliderOptions;
    },
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
     * @return {Object} user object
     */
    customResponseForTable(user, tagIds) {
      const tagCloumnProp = this.pickupTableColumnProp(this.$data.viewdata.officersTableColumn, 1);

      // 並び替えに必要なtag_idと役員名をレスポンスの第一階層に追加する。
      user.tags.forEach(tag => {
        if (tagIds.includes(tag.tag_id)) {
          user[tagCloumnProp] = tag.name_ja;
          user['sortNumber'] = tag.tag_id;
        }
      });

      user['graduate_date_str'] = `${user.graduate_date}年卒`;
      return user;
    },

    /**
     * モーダル開閉処理。
     */
    openCardModal(el, labels) {
      this.card.modal.isShow = true;
      this.card.modal.el = el;
      this.card.modal.labels = labels;
      document.body.classList.add("modal-open");
    },
    closeCardModal() {
      this.card.modal.isShow = false;
      document.body.classList.remove("modal-open");
    },
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
