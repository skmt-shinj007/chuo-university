<template>
<div class="footer-wrap">
  <footer class="footer">
    <div class="footer__contact">
      <contents-title-component
      :title="messages.SectionTitles.Contact.Main"
      :subTitle="messages.SectionTitles.Contact.Sub"
      color="white"/>

      <div class="footer__contact-lead">
        <p class="footer__contact-text nl2br" v-text="messages.Footer.LeadContact"/>
      </div>

      <div class="footer__contact-btn">
        <primary-button-component :name="messages.ButtonName.ToContact"/>
      </div>
    </div>

    <ul class="footer__menu">
      <li class="footer__menu-item" v-for="(link, n) in links" :key="n">
        <accordion-link-component :item="link"/>
      </li>
    </ul>
  </footer>
</div>
</template>

<script>
// component import
import AccordionLinkComponent from '../modules/accordion/AccordionLinkComponent.vue';
import PrimaryButtonComponent from '../modules/button/PrimaryButtonComponent.vue';
import ContentsTitleComponent from '../modules/ContentsTitleComponent.vue';

// data import
import Data from '../../config/data.json';
import Features from '../../config/features.json';

export default {
  components: {
    ContentsTitleComponent,
    PrimaryButtonComponent,
    AccordionLinkComponent,
  },
  data() {
    return {
      data: Data,
      features: Features,
      links: [],
    }
  },
  beforeMount() {
    this.$data.features.FooterLinks.forEach(element => this.links.push(element));
  },
}
</script>

<style lang="scss" scoped>
.footer {
  padding: 0 interval(2);
  max-width: device(max);
  margin: 0 auto;

  &-wrap {
    @include gradient(color(deepDarkblue), color(lightDarkblue), horizontal);
    padding: interval(10) 0;
  }

  &__contact {
    color: color(white);
  }

  &__contact-lead {
    max-width: interval(40);
    margin: 0 auto;
  }

  &__contact-btn {
    margin-top: interval(5);
  }

  &__menu {
    margin-top: interval(10);
  }
}
</style>
