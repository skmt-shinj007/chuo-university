<template>
  <div class="top">
    <main-visual-component/>

    <section class="top__news">
      <news-component/>
    </section>

    <section class="top__team section-container">
      <figure class="top__team-img">
        <img src="/image/group-photo_toutoSpring2017.jpg" alt="2017年東都春季リーグ戦の集合写真">
      </figure>
      <lead-text-component
        class="top__team-contentsCard"
        :titles="messages.SectionTitles.Team"
        :buttonName="messages.ButtonName.Member"
        :contentsText="messages.Top.TeamDescription"/>
    </section>

    <section class="top__hakumonkai section-container">
      <figure class="top__team-img">
        <img src="/image/hakumon.jpg" alt="中央大学多摩キャンパス白門の画像">
      </figure>
      <lead-text-component
        class="top__hakumonkai-contentsCard"
        :titles="messages.SectionTitles.Hakumonkai"
        :buttonName="messages.ButtonName.Hakumonkai"
        :contentsText="messages.Top.HakumonkaiDescription"/>
    </section>

    <section class="top__menuPanel section-container">
      <!-- TODO:コンポーネントを v-for しない -->
      <!-- TODO:data.jsonからオブジェクトを引っ張る -->
      <menu-panel-component
        class="top__menuPanel-item"
        v-for="(menuPanelItem, n) in menuPanels"
        :key="n"
        :menuPanelData="menuPanelItem"/>
    </section>

    <div class="background-image">
      <div class="background-darkblue">
        <section class="top__support section-container">
          <contents-title-component title="support" subTitle="サポート" color="white"/>
          <div class="top__support-textaria">
            <p class="nl2br" v-text="messages.Top.Support"/>
          </div>
        </section>
      </div>
    </div>

  </div>
</template>

<script>
// component import
import Data from '../config/data.json';
import MainVisualComponent from '../components/contents/MainVisualComponent';
import NewsComponent from '../components/contents/NewsComponent.vue';
import LeadTextComponent from '../components/contents/LeadTextComponent';
import MenuPanelComponent from '../components/modules/MenuPanelComponent.vue';
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent.vue';

export default {
  components: {
    MainVisualComponent,
    NewsComponent,
    LeadTextComponent,
    MenuPanelComponent,
    ContentsTitleComponent,
  },
  data() {
    return {
      data: Data,
      menuPanels: [],
    }
  },
  beforeMount() {
    this.$data.data.MenuPanels.forEach(element => this.menuPanels.push(element));
  },
}
</script>

<style lang="scss" scoped>
.top {
  position: relative;

  &__news {
    transform: translateY(-50px);
    max-width: 800px;
    margin: 0 auto;

    // pc style
    @include mq(md) {
      transform: none;
      margin-top: interval(15);
      margin-bottom: interval(10);
    };
  }

  &__team {

    // pc style
    @include mq(md) {
      position: relative;
      @include flex();
    };

    &-img {
      width: 100%;
      border-top: 5px solid color(darkblue);
      border-bottom: 5px solid color(darkblue);
      box-shadow: 0px -5px 8px 3px color(shadow);
      // @include imageFlame;
      @include trimming(aspect(golden));

      // pc style
      @include mq(md) {
        width: 70%;
      };
    }

    &-contentsCard {
      transform: translateY(-50px);

      // pc style
      @include mq(md) {
        position: absolute;
        top: 50%;
        right: 0;
      };
    }
  }

  &__hakumonkai {

    // pc style
    @include mq(md) {
      position: relative;
      margin-top: interval(40);
      @include flex(
        $flow: row-reverse nowrap
      );
    }

    &-img {
      width: 100%;
      border-top: 5px solid color(darkblue);
      border-bottom: 5px solid color(darkblue);
      box-shadow: 0px -5px 8px 3px color(shadow);
      // @include imageFlame;
      @include trimming(aspect(golden));

      // pc style
      @include mq(md) {
        width: 70%;
      };
    }

    &-contentsCard {
      transform: translateY(-50px);

      // pc style
      @include mq(md) {
        position: absolute;
        top: 50%;
        left: 0;
      };
    }
  }

  &__menuPanel {

    // pc style
    @include mq(md) {
      @include flex($justify-content: center);
      margin-top: interval(40);
    };

    &-item {
      max-width: 500px;
      margin: 0 auto;

      // tablet style
      @include mq(sm) {
        width: 70%;
      };

      // pc style
      @include mq(md) {
        padding: interval(0.5);
        max-width: 340px;
      };
    }
  }

  &__support {
    width: 100%;
    height: 100%;
    color: color(white);
    @include flex(column nowrap, center, center);

    &-textaria {
      width: 80%;
      margin: 0 auto;

      // tablet style
      @include mq(sm) {
        width: 70%;
      };

      // pc style
      @include mq(md) {
        width: 60%;
      };
    }
  }

  .background-image {
    width: 100%;
    height: 100vh;
    @include background-image(
      $url: "/image/player09.jpg",
      $position: center center
    );

    // tablet style
    @include mq(sm) {
      @include background-image(
      $url: "/image/player11.jpg",
      $position: center center
      );
    };
  }

  .background-darkblue {
    width: 100%;
    height: 100%;
    background-color: rgba($color: color(darkblue), $alpha: .8);
  }
}
</style>
