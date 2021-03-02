<template>
  <div class="home">
    <div class="home__main-visual">
      <main-visual-component/>
    </div>

    <section class="home__news">
      <news-component/>
    </section>

    <section class="home__about">
      <div class="about" v-for="(aboutItem, n) in aboutItems" :key="n">
        <figure class="about__img">
          <img :src="`/image/${aboutItem.img.src}.jpg`" :alt="aboutItem.img.alt">
        </figure>

        <div class="about__lead">
          <text-box-component :contentProps="aboutItem"/>
        </div>
      </div>
    </section>

    <div class="home__background">
      <section class="home__support">
        <contents-title-component
          :title="messages.SectionTitles.Support.Main"
          :subTitle="messages.SectionTitles.Support.Sub"
          color="white"/>

        <div class="support__text">
          <p class="nl2br" v-text="messages.Home.Support"/>
        </div>
      </section>
    </div>

  </div>
</template>

<script>
// component import
import Data from '../config/data.json';
import MainVisualComponent from '../components/contents/MainVisualComponent';
import NewsComponent from '../components/contents/NewsComponent';
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import TextBoxComponent from '../components/modules/TextBoxComponent';

export default {
  components: {
    MainVisualComponent,
    NewsComponent,
    ContentsTitleComponent,
    TextBoxComponent,
  },

  data() {
    return {
      data: Data,
      aboutItems: [],
    }
  },

  beforeMount() {
    // アバウトセクションを生成するデータを挿入。
    this.$data.data.HomeAbout.forEach(element => this.aboutItems.push(element));
  },
}
</script>

<style lang="scss" scoped>
.home {
  position: relative;

  &__news {
    transform: translateY(-50px);
    max-width: interval(100);
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
      @include background-image("/image/player09.jpg");

      @include mq(sm) {
        @include background-image("/image/player11.jpg", center center);
      }
    }

    @include mq(sm) {
      height: auto;
    }
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
    .about__lead {
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

  &__lead {
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
}

.support {
  &__text {
    width: 80%;
    margin: 0 auto;
  }
}
</style>
