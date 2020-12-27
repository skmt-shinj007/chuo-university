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

  <section class="member__players section-container">
    <contents-title-component
      :title="messages.SectionTitles.Players.Main"
      :subTitle="messages.SectionTitles.Players.Sub"/>

    <div class="member__user-ticket-group">
      <div class="member__user-ticket" v-for="(player, n) in players" :key="n">
        <user-ticket-component :userObj="player"/>
      </div>
    </div>
  </section>

  <section class="member__staff section-container">
    <contents-title-component
      :title="messages.SectionTitles.Staff.Main"
      :subTitle="messages.SectionTitles.Staff.Sub"/>

    <div class="member__user-ticket-group">
      <div class="member__user-ticket" v-for="(staffItem, n) in staff" :key="n">
        <user-ticket-component :userObj="staffItem"/>
      </div>
    </div>
  </section>
</div>
</template>

<script>
// component import
import MainVisualComponent from '../components/contents/MainVisualComponent';
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import UserTicketComponent from '../components/modules/ticket/UserTicketComponent';

// data import
import Data from '../config/data.json';

export default {
  components: {
    MainVisualComponent,
    ContentsTitleComponent,
    UserTicketComponent,

  },
  data() {
    return {
      data: Data,
      players: [],
      staff: [],
    }
  },
  beforeMount() {
    // TODO:DBから情報を引っ張る
    this.$data.data.Players.forEach(element => this.players.push(element));
    this.$data.data.Staff.forEach(element => this.staff.push(element));

    /**
     * SP表示のときにメインビジュアルテキストの改行を増やす
     * *ウインドウ幅がリアルタイム取得ではないので、改行増はリロードする必要がある。
     * （そもそもPC幅からSP幅に移行する場面は想定できないのでこの作りでOKな気がする）
     */
    if (this.windowWidth < 560) {
      this.$data.messages.MainVisual.Member = "CHUO UNIVERSITY\nSOFT TENNIS\nTEAM MEMBER";
      return this.$data.messages.MainVisual.Member;
    }
  },

}
</script>

<style lang="scss" scoped>
.member {
  background-color: color(lightgray);

  &__main-visual-icon {
    width: interval(30);
    height: interval(30);
    fill: color(white);
    stroke: color(orange);

    @include mq(md) {
      width: 40%;
      height: 40%;
      min-width: interval(60);
      min-height: interval(60);
    }
  }

  &__main-visual-ward {
    @include bangers(font(mv), 1px, 400);
    color: color(white);
    line-height: 1.2;
    margin: 0 interval(1);

    @include mq(sm) {
      text-align: center;
    }
  }

  &__user-ticket-group {
    @include flex(column nowrap, center, flex-start);

    @include mq(sm) {
      @include flex(row wrap, flex-start, center);
    }
  }

  &__user-ticket {
    padding: interval(1);
    margin-bottom: interval(5);
    width: 90%;
    max-width: interval(48);

    @include mq(sm) {
      width: calc(100% / 2);
      max-width: none;
    }

    @include mq(md) {
      margin-bottom: 0;
      width: calc(100% / 3);
    }

    &:nth-child(even) {
      align-self: flex-end;

      @include mq(sm) {
        align-self: auto;
      }
    }

    &:last-child {
      margin-bottom: 0;
    }
  }

}
</style>
