<template>
<div class="member">
  <div class="member__main-visual">
    <main-visual>
      <template v-slot:inner>
        <div class="main-visual__wrap">
          <svg-vue class="main-visual__icon" icon="chuo-logo"/>
          <div class="main-visual__text">
            <span
              class="main-visual__character delay"
              v-for="(t, i) in mvText"
              :key="i"
              v-text="t"
              :style="{ animationDelay: i*150+'ms' }"
            />
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
        v-for="player in user.players"
        :key="player.id">

          <user-ticket :user="player"/>
      </div>
    </div>
  </section>

  <section class="member__staff">
    <contents-title :title="messages.SectionTitles.Staff"/>
    <div class="member__ticket-group">
      <div
        class="member__ticket"
        ref="staffTicket"
        v-for="staff in user.staff"
        :key="staff.id">

          <user-ticket :user="staff"/>
      </div>
    </div>
  </section>

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
import UserTicket from '../components/modules/ticket/UserTicketComponent';

// config import
import Data from '../config/data.json';
import Api from '../config/api/index';

export default {
  components: {
    MainVisual,
    ContentsTitle,
    UserTicket,
    ScrollTopButton,
  },

  mixins: [Risize],

  data() {
    return {
      data: Data,

      /**
       * メインビジュアルのテキスト
       * @type { string }
       */
      mvText: '',

      user: {
        players: [],
        staff: [],
      }
    }
  },

  created() {
    this.getPlayer();
    this.getStaff();
    this.mvText = this.messages.MainVisual.Member.Text;
  },

  methods: {
    /**
     * ユーザー取得
     * TODO：引数を使用して1つの関数にできそう。
     * どこに代入するかの指定を引数でできれば解決。
     */
    async getPlayer() {
      const response = await Api.getResponse('/player');
      (this.getType(response.data) === 'array') ? this.user.players = response.data : new Error('player:レスポンスが配列ではありません。');
    },
    async getStaff() {
      const response = await Api.getResponse('/staff');
      (this.getType(response.data) === 'array') ? this.user.staff = response.data : new Error('staff:レスポンスが配列ではありません。');
    },
  },
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
    max-width: pixel(50);
    margin: 0 auto;

    @include mq(sm) {
      @include flex(row wrap);
      max-width: pixel(60);
    }

    @include mq(md) {
      max-width: none;
    }
  }

  &__ticket {
    padding: interval(1);
    width: 100%;

    @include mq(md) {
      width: calc(100% / 3);
    }

    @include mq(lg) {
      width: calc(100% / 4);
    }
  }

  &__scroll-top {
    @include scroll-top();
  }
}

.main-visual {
  &__wrap {
    @include flex(column nowrap, center, center);
  }

  &__icon {
    width: interval(30);
    fill: color(white);
    stroke: color(orange);
    stroke-width: pixel(1);
  }

  &__text {
    margin-top: interval(2);
    text-align: center;

    @include mq(sm) {
      width: auto;
    }
  }

  &__character {
    display: inline-block;
    line-height: 1.2;
    font-size: font(30);
    margin-right: interval(.5);
    color: color(white);
    animation: textIn .8s cubic-bezier(0.22, 0.15, 0.25, 1.43) 0s backwards;

    &:nth-child(4) {
      margin-right: interval(1);
    }

    &:last-child {
      margin-right: 0;
    }
  }
}
</style>
