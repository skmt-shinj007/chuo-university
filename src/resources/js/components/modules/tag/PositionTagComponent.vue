<template>
<div class="position-tag">
  <tag :color="positionColor" :content="position" :size="size" :responsive="responsive"/>
</div>
</template>

<script>
// component import
import Tag from './TagComponent'

export default {
  components: {
    Tag
  },

  props: {
    // [ポジション]
    position: {
      type: String,
      default: ''
    },

    // [タグサイズ]
    size: {
      type: String,
      default: ''
    },

    // レスポンシブ フラグ
    responsive: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    /**
     * [ポジションに合わせてタグ色を決める]
     * @type { function }
     * @return { string } 変数colorが返る
     */
    positionColor() {
      // returnする変数を定義
      let color = '';
      // ポジションに合わせて色を代入
      if (this.position === '後衛') {
        color = 'lightgreen';
      } else if (this.position === '前衛') {
        color = 'orange';
      } else if (this.position === '日本代表監督') {
        color = 'red';
      }

      return color;
    }
  },
}
</script>
