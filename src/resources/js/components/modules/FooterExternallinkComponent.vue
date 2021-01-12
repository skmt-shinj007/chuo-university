<template>
  <ul class="external-link">
    <li class="external-link__list" v-for="externalLink in externalLinks" :title="externalLink.name" :key="externalLink.linkUrl">
      <a class="external-link__item" :href="externalLink.linkUrl">{{ externalLink.name }}</a>
    </li>
  </ul>
</template>

<script>
export default {
  data() {
    return {
      externalLinks: [
        {
          name: "中央大学HP",
          linkUrl: "https://www.chuo-u.ac.jp/",
        },
        {
          name: "立命館大学ソフトテニス部",
          linkUrl: "http://www5c.biglobe.ne.jp/~rst/",
        },
        {
          name: "日本学生ソフトテニス連盟",
          linkUrl: "https://www.jssta.jp/",
        },
        {
          name: "関東学生ソフトテニス連盟",
          linkUrl: "https://kssta.net/",
        }
      ]
    }
  },
}
</script>

<style lang="scss">
.external-link {
  width: 60%;
  max-width: 300px;
  margin: 0 auto;

  // tablet style
  @include mq(sm) {
    width: 100%;
    max-width: none;
  };

  &__list {
    margin-bottom: interval(1);
    line-height: 2;

    // tablet style
    @include mq(sm) {
      margin-bottom: interval(0.5);
    };

    &:last-child {
      margin: 0;
    }
  }

  &__item {
    padding: interval(0.5) interval(2);
    position: relative;
    font-size: font(sm);
    @include middle-line-text(1, 2px, color(white));
  }
}
</style>
