<template>
  <div class="home">
    <div class="home__main-visual">
      <main-visual-component/>
    </div>

    <section class="home__news">
      <news-component/>
    </section>

    <section class="home__about">
      <div class="home__about-item" v-for="(aboutItem, n) in aboutItems" :key="n">
        <figure class="home__img">
          <img :src="`/image/${aboutItem.img.src}.jpg`" :alt="aboutItem.img.alt">
        </figure>

        <div class="home__lead">
          <text-box-component
          :titles="aboutItem.title"
          :buttonName="aboutItem.button.name"
          :contentsText="aboutItem.text"/>
        </div>
      </div>
    </section>

    <div class="home__background-image">
      <div class="home__background-darkblue">
        <section class="home__support">
          <contents-title-component
            :title="messages.SectionTitles.Support.Main"
            :subTitle="messages.SectionTitles.Support.Sub"
            color="white"/>

          <div class="home__support-textaria">
            <p class="nl2br" v-text="messages.Home.Support"/>
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

  &__about-item {

    @include mq(md) {
      position: relative;
      @include flex(row wrap);
      margin-top: - interval(10);

      &:first-child {
        margin-top: 0;
      }
    }
  }

  // 偶数個のアバウトメニュースタイル
  &__about-item:nth-child(even) {

    @include mq(md) {
      @include flex(row-reverse wrap);
    }

    // テキストボックスを左寄せにする
    .home__lead {
      @include mq(md) {
        margin: 0 auto 0 0;
      }
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

  &__support {
    margin-bottom: 0;
    padding-top: interval(15);
    padding-bottom: interval(20);
    color: color(white);
    @include flex(column nowrap, center, center);

    &-textaria {
      width: 80%;
      margin: 0 auto;

      @include mq(sm) {
        width: 70%;
      }

      @include mq(md) {
        width: 60%;
      }
    }
  }

  &__background-image {
    width: 100%;
    height: 100vh;
    @include background-image("/image/player09.jpg");

    @include mq(sm) {
      height: auto;
      @include background-image("/image/player11.jpg");
    }
  }

  &__background-darkblue {
    width: 100%;
    height: 100%;
    background-color: rgba($color: color(darkblue), $alpha: .8);
  }
}
</style>
