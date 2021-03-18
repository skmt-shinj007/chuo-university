<template>
<div class="member">
  <div class="member__main-visual">
    <main-visual>
      <template v-slot:inner>
        <div class="main-visual__wrap">
          <svg-vue class="main-visual__icon" icon="chuo-logo"/>
          <div class="main-visual__text-group">
            <div class="main-visual__text" v-for="(text, n) in texts" :key="n">
              <span
                class="main-visual__item delay"
                v-for="(t, n) in text"
                :key="n"
                v-text="t"/>
            </div>
          </div>
        </div>
      </template>
    </main-visual>
  </div>

  <section class="member__players">
    <contents-title :title="messages.SectionTitles.Players"/>

    <div class="member__ticket-group">
      <div
        class="member__ticket"
        ref="playerTicket"
        v-for="player in players"
        :key="player.id"
        @click="openModal(player)">

          <user-ticket :userObj="player"/>
      </div>

      <!-- 左寄せに並べたいので空の要素をチケット分追加 -->
      <div
        class="enpty"
        v-for="n in playerTicketNumber"
        :key="`enpty-${n}`"
        :style="{ width: `${ticketWidth}px` }"/>
    </div>
  </section>

  <section class="member__staff">
    <contents-title :title="messages.SectionTitles.Staff"/>

    <div class="member__ticket-group">
      <div
        class="member__ticket"
        ref="staffTicket"
        v-for="user in staff"
        :key="user.id"
        @click="openModal(user)">

          <user-ticket :userObj="user"/>
      </div>

      <!-- 左寄せに並べたいので空の要素をチケット分追加 -->
      <div
        class="enpty"
        v-for="n in staffTicketNumber"
        :key="`enpty-${n}`"
        :style="{ width: `${ticketWidth}px` }"
      />
    </div>
  </section>

  <user-modal v-if="showModal" @close="closeModal" :item="clickElement"/>

  <div class="member__scroll-top">
    <scroll-top-button/>
  </div>

</div>
</template>

<script>
// mixin
import Risize from '../config/resize';

// component import
import MainVisual from '../components/contents/MainVisualComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import UserModal from '../components/modules/modal/UserModalComponent.vue';
import TableComponent from '../components/modules/table/TableComponent.vue';
import UserTicket from '../components/modules/ticket/UserTicketComponent';

// data import
import Data from '../config/data.json';

export default {
  components: {
    MainVisual,
    ContentsTitle,
    UserTicket,
    UserModal,
    TableComponent,
    ScrollTopButton,
  },

  mixins: [Risize],

  data() {
    return {
      data: Data,

      /**
       * メインビジュアルのテキスト
       * @type { Object }
       */
      texts: {},

      users: [],     // 全ユーザー
      players: [],  // プレイヤー
      staff: [],    // スタッフ

      /**
       * [モーダル表示フラグ]
       * @type { Boolean }
       */
      showModal: false,

      /**
       * [モーダルに渡すデータ]
       * @type { Object }
       */
      clickElement: null,

      /**
       * [各チケットの要素数]
       * @type { Number }
       */
      playerTicketNumber: 0,
      staffTicketNumber: 0,

      /**
       * [チケットのwidth]
       * @type { Number }
       */
      ticketWidth: 0,
    }
  },

  beforeMount() {
    // TODO:以下DBから情報を引っ張る

    // 全ユーザーを取得
    this.$data.data.Users.forEach(element => this.users.push(element));

    // usersプロパティから選手のみを抽出
    this.users.forEach(element => {
      (element.category === this.playerNum) ? this.players.push(element) : null;
    });

    // usersプロパティからスタッフのみを抽出
    this.users.forEach(element => {
      (element.category === this.staffNum) ? this.staff.push(element) : null;
    });

    this.texts = this.messages.MainVisual.Member;
  },

  mounted() {
    /**
     * [チケットレイアウトの配置]
     * justify-content: center; は余った要素が真ん中よりになるので、左寄せに揃えるための処理
     * 解決策 -> チケットの数だけ空divを追加する。
     */
    const playerTicket = this.$refs.playerTicket;
    const staffTicket = this.$refs.staffTicket;

    // チケットの個数を変数に格納
    this.playerTicketNumber = playerTicket.length;
    this.staffTicketNumber = staffTicket.length;

    /**
     * 初期描画時のにチケットの幅を取得
     */
    this.getTicketWidth();
  },

  methods: {
    /**
     * [モーダル開閉処理]
     */
    openModal(el) {
      this.showModal = true;
      this.clickElement = el;
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.showModal = false;
      document.body.classList.remove("modal-open");
    },

    /**
     * [チケットの幅を変数にぶち込む]
     * removeEventListener > 無名関数だと解除できないので処理をメソッドとして登録
     */
    getTicketWidth() {
      this.ticketWidth = this.$refs.playerTicket[0].offsetWidth;
    },
  },

  watch: {
    windowWidth() {
      this.getTicketWidth();
    }
  }
}
</script>

<style lang="scss" scoped>
.member {

  &__players {
    margin-top: interval(5);
  }

  &__staff {
    padding-bottom: interval(10);
    margin-bottom: 0;
  }

  &__ticket-group {
    @include flex(column nowrap, center, center);

    @include mq(sm) {
      @include flex(row wrap, center, center);
    }
  }

  &__ticket {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin-bottom: 0;
      padding: interval(1);
    }
  }

  &__scroll-top {
    @include scroll-top();
  }
}

.main-visual {

  &__wrap {
    @include flex(column nowrap, center, center);

    @include mq(sm) {
      flex-direction: row;
    }
  }

  &__icon {
    width: interval(36);
    fill: color(white);
    stroke: color(orange);
    stroke-width: pixel(1);

    @include mq(sm) {
      width: interval(28);
    }
  }

  &__text-group {
    margin-top: interval(2);

    @include mq(sm) {
      margin: 0 0 0 interval(1);
      flex-grow: 2;
    }

    @include mq(md) {
      margin-left: interval(3);
    }
  }

  &__text {
    text-align: center;

    @include mq(sm) {
      text-align: left;
    }
  }

  &__item {
    text-shadow: none;
    line-height: 1.2;
    font-size: font(40);
    margin-right: interval(1);

    &:last-child {
      margin-right: 0;
    }

    @include mq(sm) {
      font-size: font(36);
      margin-right: interval(.5);
    }

    @include mq(md) {
      font-size: font(48);
    }
  }

  @for $i from 1 through 2 {
    &__item:nth-child(#{$i}) {
      animation-delay: $i * 100ms + 200ms;
    }
  }
}

.ticket {
  &-enter-active {
    transition: opacity .5s, transform .5s ease-out;
  }

  &-enter {
    transform: translateY(-50px);
    opacity: 0;
  }
}
</style>
