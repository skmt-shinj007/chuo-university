<template>
<footer class="l-footer p-footer">
  <div class="p-footer__mainContents">
    <div class="p-footer__mainContents-sitemap">
      <footer-title-component class="p-footer__mainContents-title" footerTitle="SITE MAP"/>
      <footer-sitemap-component/>
    </div>

    <div class="p-footer__mainContents-externalLink">
      <footer-title-component class="p-footer__mainContents-title" footerTitle="EXTERNAL LINK"/>
      <footer-externallink-component/>
    </div>

    <div class="p-footer__mainContents-information">
      <footer-title-component class="p-footer__mainContents-title" footerTitle="INFORMATION"/>
      <ul class="p-footer__mainContents-information-wrap">
        <li class="p-footer__mainContents-information-list">{{ messages.Footer.Information.ClubName }}</li>
        <li class="p-footer__mainContents-information-list">{{ messages.Footer.Information.Address }}</li>
        <li class="p-footer__mainContents-information-list">{{ messages.Footer.Information.TelephoneNumber }}</li>
        <li class="p-footer__mainContents-information-list">{{ messages.Footer.Information.MailAddress }}</li>
        <li class="p-footer__mainContents-information-list">{{ messages.Footer.Information.Caretaker }}</li>
      </ul>
    </div>
  </div>

  <div class="p-footer__endText">
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
.l-footer {
  background-color: color(darkblue);
  color: color(white);
  font-weight: bold;
}

.p-footer__mainContents {
  margin-bottom: interval(3);

  // tablet style
  @include mq(sm) {
    @include flex($justify-content: center);
  };

  &-title {
    margin-bottom: interval(3);
  }

  &-sitemap {
    padding-top: interval(10);

    // tablet style
    @include mq(sm) {
      padding-top: 0;
      margin-top: interval(5);
      padding: 0 interval(2);
    };
  }

  &-externalLink {
    margin-top: interval(5);

    // tablet style
    @include mq(sm) {
      padding: 0 interval(2);
    };
  }

  &-information {
    margin-top: interval(5);

    // tablet style
    @include mq(sm) {
      padding: 0 interval(2);
    };

    &-wrap {
      width: 50%;
      max-width: 300px;
      margin: 0 auto;

      // tablet style
      @include mq(sm) {
        width: 100%;
        max-width: none;
      };
    }

    &-list {
      margin-bottom: interval(0.5);
      font-size: font(xs);

      &:last-child {
        margin-bottom: 0;
      }
    }
  }
}

.p-footer__endText {
  padding: interval(3) 0;
  text-align: center;
  font-weight: normal;
  font-size: font(xs);
}
</style>
