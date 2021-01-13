<template>
  <ul class="site-map">
    <li class="site-map__list" v-for="siteMapMenu in siteMapMenus" :title="siteMapMenu.name" :key="siteMapMenu.routeName">
      <router-link class="site-map__item" :to="siteMapMenu.routeName">{{ siteMapMenu.name }}</router-link>
    </li>
  </ul>
</template>

<script>
export default {
  data() {
    return {
      siteMapMenus: [
        {
          name: "HOME",
          routeName: "/",
        },
        {
          name: "CLUB",
          routeName: "club",
        },
        {
          name: "MEMBER",
          routeName: "member",
        },
        {
          name: "HAKUMONKAI",
          routeName: "hakumonkai",
        },
        {
          name: "HISTORY",
          routeName: "history",
        },
        {
          name: "PHOTO",
          routeName: "photo",
        },
        {
          name: "CONTACT",
          routeName: "contact",
        },
      ]
    }
  },
}
</script>

<style lang="scss">
.site-map {
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
      line-height: 1.5;
    };

    &:last-child {
      margin: 0;
    }
  }

  &__item {
    padding: interval(0.5) interval(2);
    font-size: font(md);
    @include middle-line-text(1, 2px, color(white));

    // tablet style
    @include mq(sm) {
      font-size: font(sm);
    };
  }
}
</style>
