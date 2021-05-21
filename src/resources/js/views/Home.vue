<template>
  <div class="home">
    <div class="home__main-visual">
      <main-visual/>
    </div>

    <section class="home__news">
      <news/>
    </section>

    <section class="home__about">
      <div class="about" v-for="(item, n) in aboutContents" :key="n" ref="about">

        <figure class="about__img" v-fade:[dir.left]>
          <img :src="`/image/${item.img.src}.jpg`" :alt="item.img.alt">
        </figure>

        <div class="about__box">
          <div class="about__content" v-fade:[dir.up]>
            <div class="about__title">
              <contents-title :title="item.title"/>
            </div>
            <div class="about__text">
              <p class="nl2br" v-text="item.text"/>
            </div>
            <div class="about__button">
              <link-button :link="item.button"/>
            </div>
          </div>

        </div>
      </div>
    </section>

    <div class="home__background">
      <section class="home__support" v-fade:[dir.up]>
        <contents-title :title="messages.SectionTitles.Support" color="white"/>
        <div class="support__text">
          <p class="nl2br" v-text="messages.Home.Support"/>
        </div>
      </section>
    </div>

    <div class="home__scroll-top">
      <scroll-top-button/>
    </div>

  </div>
</template>

<script>
// data
import Data from '../config/data/data.json';

// mixin
import Animation from '../config/animation';

// component import
import MainVisual from '../components/contents/MainVisualComponent';
import News from '../components/contents/NewsComponent';
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import LinkButton from '../components/modules/button/LinkButtonComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';

export default {
  components: {
    MainVisual,
    News,
    ContentsTitle,
    LinkButton,
    ScrollTopButton,
  },

  mixins: [Animation],

  data() {
    return {
      data: Data,

      /**
       * アバウトセクションを生成するデータ
       */
      aboutContents: [],
    }
  },

  beforeMount() {
    // アバウトセクションを生成するデータを挿入
    this.$data.data.about.forEach(element => this.aboutContents.push(element));

    // タイトルとボタンのデータを置き換える。
    this.aboutContents.forEach(element => {
      let el = element;

      // messagesのutton, title オブジェクトを配列に変換する。
      let LinkLists = this.convertArray(this.$data.messages.Links);
      let titles = this.convertArray(this.$data.messages.SectionTitles);

      LinkLists.forEach(element => {
        if (el.button === element.key) el.button = element.value;
      });

      titles.forEach(element => {
        if (el.title === element.key) el.title = element.value;
      });
    });
  },

  methods: {
    /**
     * オブジェクトから配列に変換する処理
     * @param { Object }
     * @return [{key:hoge, value:hoge}, {key:hoge, value:hoge}, ...]
     */
    convertArray(obj) {
      return Object.entries(obj).map(([key, value]) => ({key, value}));
    },
  },
}
</script>

<style lang="scss" scoped>
.home {
  position: relative;

  &__news {
    transform: translateY(- interval(15));
    margin-bottom: 0;

    @include mq(md) {
      max-width: 80%;
    }
  }

  &__about {
    margin-bottom: 0;

    @include mq(md) {
      margin-bottom: - interval(5);
    }
  }

  &__support {
    height: 100%;
    margin-bottom: 0;
    color: color(white);
    @include flex(column nowrap, center, center);

    @include mq(sm) {
      padding-top: interval(5);
      padding-bottom: interval(10);
    }
  }

  &__background {
    position: relative;
    width: 100%;
    height: 100vh;
    background-color: rgba($color: color(darkblue), $alpha: .8);

    &::before {
      display: block;
      content: '';
      position: absolute;
      z-index: -1;
      width: 100%;
      height: 100%;
      @include background-image("/image/support_sp.jpg");

      @include mq(sm) {
        @include background-image("/image/support_pc.jpg", center center);
      }
    }

    @include mq(sm) {
      height: auto;
    }
  }

  &__scroll-top {
    @include scroll-top();
  }
}

.about {

  @include mq(md) {
    position: relative;
    @include flex(row wrap);
    margin-top: - interval(10);

    &:first-child {
      margin-top: 0;
    }
  }

  &:nth-child(even) {

    @include mq(md) {
      @include flex(row-reverse wrap);
    }

    // テキストボックスを左寄せにする
    .about__box {
      @include mq(md) {
        margin: 0 auto 0 0;
      }
    }
  }

  &__img {
    width: 100%;
    border-top: 5px solid color(darkblue);
    border-bottom: 5px solid color(darkblue);
    box-shadow: 0px -5px 8px 3px color(shadow);
    @include trimming(aspect(golden));

    @include mq(md) {
      width: 80%;
      min-width: interval(66);
    }
  }

  &__box {
    width: 90%;
    max-width: interval(100);
    margin: 0 auto;
    transform: translateY(-15%);

    @include mq(sm) {
      transform: translateY(-20%);
    }

    @include mq(md) {
      min-width: interval(60);
      width: 60%;
      margin: 0 0 0 auto;
      transform: translateY(-40%);
    }
  }

  &__content {
    padding: 0 interval(2) interval(2) interval(2);
    background-color: rgba($color: color(white), $alpha: .8);
    box-shadow: 0px 6px 8px color(shadow);

    @include mq(sm) {
      padding: 0 interval(3) interval(3) interval(3);
    }

    @include mq(md) {
      @include flex(column nowrap, center, center);
      min-height: interval(50);
    }
  }

  &__text {
    margin-bottom: interval(5);
  }

  &__button {
    width: 100%;

    @include mq(sm) {
      max-width: 80%;
      margin: 0 auto;
    }
  }
}

.support {
  &__text {
    width: 80%;
    margin: 0 auto;
  }
}
</style>
