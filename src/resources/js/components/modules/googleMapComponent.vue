<template>
<div class="google-map">
  <!-- google map 埋め込み（中央大学多摩キャンパス ソフトテニスコート） -->
  <iframe class="google-map__map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1621.2667723739717!2d139.3969191414313!3d35.63922419623377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018e3e36092b1eb%3A0xbda5deeac6e07b45!2z5Lit5aSu5aSn5a2mIOWkmuaRqeOCreODo-ODs-ODkeOCuSDjgr3jg5Xjg4jjg4bjg4vjgrnjgrPjg7zjg4g!5e0!3m2!1sja!2sjp!4v1606833350051!5m2!1sja!2sjp" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  <span class="google-map__attentionText">{{ messages.Club.AttentionText }}</span>
</div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.google-map {

  &__map {
    width: 100%;
    height: $map-height-sp;

    @include mq(md) {
      height: $map-height-pc;
    }
  }

  &__attentionText {
    margin: interval(1) auto 0 auto;
    display: block;
    width: 80%;
    text-align: center;
    font-size: font(xs);
    font-weight: normal;
    letter-spacing: 1.5px;

    @include mq(md) {
      text-align: end;
      width: 100%;
      padding: 0 interval(1);
    }
  }
}
</style>
