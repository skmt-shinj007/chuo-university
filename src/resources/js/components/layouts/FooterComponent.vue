<template>
<footer class="footer">
  <div class="footer__main-contents">
    <div class="footer__sitemap">
      <footer-title-component class="footer__titles" footerTitle="SITE MAP"/>
      <footer-sitemap-component/>
    </div>

    <div class="footer__external-link">
      <footer-title-component class="footer__titles" footerTitle="EXTERNAL LINK"/>
      <footer-externallink-component/>
    </div>

    <div class="footer__information">
      <footer-title-component class="footer__titles" footerTitle="INFORMATION"/>
      <ul class="footer__information-list">
        <li class="footer__information-list-item">{{ messages.Footer.Information.ClubName }}</li>
        <li class="footer__information-list-item">{{ messages.Footer.Information.Address }}</li>
        <li class="footer__information-list-item">{{ messages.Footer.Information.TelephoneNumber }}</li>
        <li class="footer__information-list-item">{{ messages.Footer.Information.MailAddress }}</li>
        <li class="footer__information-list-item">{{ messages.Footer.Information.Caretaker }}</li>
      </ul>
    </div>
  </div>

  <div class="footer__end">
    {{ messages.Footer.EndText }}
  </div>
</footer>
</template>

<script>
// component import
import FooterTitleComponent from '../modules/FooterTitleComponent';
import FooterSitemapComponent from '../modules/FooterSitemapComponent';
import FooterExternallinkComponent from '../modules/FooterExternallinkComponent';

export default {
  components: {
    FooterTitleComponent,
    FooterSitemapComponent,
    FooterExternallinkComponent,
  },
}
</script>

<style lang="scss" scoped>
.footer {
  background-color: color(darkblue);
  color: color(white);
  font-weight: bold;

  &__main-contents {
    margin-bottom: interval(3);

    // tablet style
    @include mq(sm) {
      @include flex(row nowrap, center);
    }
  }

  &__titles {
    margin-bottom: interval(3);
    @include bangers();
  }

  &__sitemap {
    padding-top: interval(10);

    @include mq(sm) {
      padding-top: 0;
      margin-top: interval(5);
      padding: 0 interval(2);
    }
  }

  &__external-link {
    margin-top: interval(5);

    @include mq(sm) {
      padding: 0 interval(2);
    }
  }

  &__information {
    margin-top: interval(5);

    @include mq(sm) {
      padding: 0 interval(2);
    }

    &-list {
      width: 50%;
      max-width: 300px;
      margin: 0 auto;

      @include mq(sm) {
        width: 100%;
        max-width: none;
      }
    }

    &-list-item {
      margin-bottom: interval(0.5);
      font-size: font(xs);

      &:last-child {
        margin-bottom: 0;
      }
    }
  }

  &__end {
    padding: interval(3) 0;
    text-align: center;
    font-weight: normal;
    font-size: font(xs);
  }
}
</style>
