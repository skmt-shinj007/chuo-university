<template>
<div class="member">
  <div class="member__main-visual">
    <main-visual>
      <template v-slot:inner>
        <div class="main-visual__wrap">
          <svg-vue class="main-visual__logo" icon="chuo-logo"/>
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
    <transition-group
      name="ticket"
      class="member__ticket-group"
      tag="div"
      @before-enter="delay"
      @after-enter="cancelDelay">

      <div class="member__ticket" v-for="(player, i) in players" :key="player.id" :data-index="i">
        <player-ticket :player="player"/>
      </div>
    </transition-group>
  </section>

  <section class="member__staff">
    <contents-title :title="messages.SectionTitles.Staff"/>
    <transition-group
      name="ticket"
      class="member__ticket-group"
      tag="div"
      @before-enter="delay"
      @after-enter="cancelDelay">

      <div class="member__ticket" v-for="(staff, i) in staff" :key="staff.id" :data-index="i">
        <staff-ticket :staff="staff"/>
      </div>
    </transition-group>
  </section>

  <div class="member__scroll-top">
    <scroll-top-button/>
  </div>

</div>
</template>

<script>
// component import
import MainVisual from '../components/contents/MainVisualComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import PlayerTicket from '../components/modules/ticket/PlayerTicketComponent';
import StaffTicket from '../components/modules/ticket/StaffTicketComponent';

import Risize from '../config/resize';

export default {
  components: {
    MainVisual,
    ContentsTitle,
    PlayerTicket,
    StaffTicket,
    ScrollTopButton,
  },

  mixins: [Risize],

  data() {
    return {
      /**
       * メインビジュアルのテキスト
       * @type { string }
       */
      mvText: '',
    }
  },

  computed: {
    // app.jsのUserAPIレスポンスを取りに行く。
    players() {
      return this.$parent.users.players;
    },
    staff() {
      return this.$parent.users.staff;
    },
  },

  created() {
    this.mvText = this.messages.MainVisual.Member.Text;
  },

  methods: {
    /**
     * transition methods
     */
    delay(el) {
      el.style.transitionDelay = 120 * parseInt(el.dataset.index, 10) + 'ms';
    },
    cancelDelay(el) {
      el.style.transitionDelay = '';
    }
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
      max-width: none;
    }
  }

  // カード幅の計算に使うために変数に格納
  $card-margin: interval(.5);

  &__ticket {
    padding: interval(1);
    margin: $card-margin;
    width: 100%;

    @include mq(sm) {
      width: calc((100% / 2) - (#{$card-margin} * 2));
    }

    @include mq(md) {
      width: calc((100% / 3) - (#{$card-margin} * 2));
    }

    @include mq(lg) {
      width: calc((100% / 4) - (#{$card-margin} * 2));
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

  &__logo {
    width: interval(28);
    fill: color(white);
    stroke: color(orange);
    stroke-width: pixel(1);
  }

  &__text {
    margin-top: interval(2);
    text-align: center;
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

// チケットの表示アニメーション
.ticket {
  &-enter-active {
    transition: opacity .5s;
  }

  &-enter {
    opacity: 0;
  }
}
</style>
