<template>
<div class="member">
  <div class="member__main-visual">
    <main-visual-component>
      <template v-slot:inner>
        <svg-vue class="member__main-visual-icon" icon="chuo-logo"/>
        <span class="member__main-visual-ward nl2br" v-text="messages.MainVisual.Member"/>
      </template>
    </main-visual-component>
  </div>

  <section class="member__players">
    <contents-title-component
      :title="messages.SectionTitles.Players.Main"
      :subTitle="messages.SectionTitles.Players.Sub"/>

    <div class="member__user-ticket-group">
      <div class="member__user-ticket" ref="playerTicket"
          v-for="(player, n) in players"
          :key="n"
          @click="openModal(player)">

        <user-ticket-component :userObj="player"/>
      </div>
      <!-- 左寄せに並べたいので空の要素をチケット分追加 -->
      <div
        class="enpty"
        v-for="n in playerTicketNumber"
        :key="`enpty-${n}`"
        :style="{ width: `${ticketWidth}px` }"
      />
    </div>

    <ticket-modal-component v-if="showModal" @close="closeModal" :item="clickElement"/>

  </section>

  <section class="member__staff">
    <contents-title-component
      :title="messages.SectionTitles.Staff.Main"
      :subTitle="messages.SectionTitles.Staff.Sub"/>

    <div class="member__user-ticket-group">
      <div class="member__user-ticket" ref="staffTicket" v-for="(staffItem, n) in staff" :key="n">
        <user-ticket-component :userObj="staffItem"/>
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
</div>
</template>

<script>
// component import
import MainVisualComponent from '../components/contents/MainVisualComponent';
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import TicketModalComponent from '../components/modules/modal/TicketModalComponent.vue';
import UserTicketComponent from '../components/modules/ticket/UserTicketComponent';

// data import
import Data from '../config/data.json';

export default {
  components: {
    MainVisualComponent,
    ContentsTitleComponent,
    UserTicketComponent,
    TicketModalComponent,
  },
  data() {
    return {
      data: Data,
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
       * 各チケットの要素数
       * @type { Number }
       */
      playerTicketNumber: 0,
      staffTicketNumber: 0,

      /**
       * ユーザーチケットの幅 (width)
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
     * 1.描画後にチケットの幅を取得（デフォ値を代入）
     * 2.チケットのサイズをリアルタイムで取得
     */
    this.getTicketWidth();
    window.addEventListener('resize', this.getTicketWidth);
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

  beforeDestroy() {
    /**
     * コンポーネント破棄直前にイベントを削除
     * ! 無名関数はイベント解除できないので注意
     */
    window.removeEventListener('resize', this.getTicketWidth);
  },
}
</script>

<style lang="scss" scoped>
.member {
  background-color: color(lightgray);

  &__main-visual-icon {
    width: 80%;
    max-width: interval(40);
    fill: color(white);
    stroke: color(orange);
    stroke-width: interval(1);

    @include mq(sm) {
      width: 50%;
    }

    @include mq(md) {
      max-width: interval(60);
    }
  }

  &__main-visual-ward {
    @include bangers(font(24), 1px, 400);
    color: color(white);
    letter-spacing: 1.8px;
    line-height: 1.2;
    text-align: center;
    margin-top: interval(5);

    @include mq(sm) {
      font-size: font(28);
    }

    @include mq(md) {
      font-size: font(48);
    }
  }

  &__players {
    margin-top: interval(5);
  }

  &__user-ticket-group {
    @include flex(column nowrap, center, center);

    @include mq(sm) {
      @include flex(row wrap, center, center);
    }
  }

  &__user-ticket {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin-bottom: 0;
      padding: interval(1);
    }

    @include mq(md) {

    }
  }

  &__staff {
    padding-bottom: interval(10);
    margin-bottom: 0;
  }
}
</style>
