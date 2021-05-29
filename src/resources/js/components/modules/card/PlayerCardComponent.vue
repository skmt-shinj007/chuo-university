<template>
<!-- APIレスポンスを使う から -->
<div class="player-card" @click="open">
  <figure class="player-card__figure">
    <img :src="player.img.src" :alt="player.img.alt" @error="noImage">
  </figure>

  <div class="player-card__information">
    <div class="player-card__name">
      <span class="player-card__name-ja">{{ player.name_ja }}</span>
      <span class="player-card__name-en">{{ player.name_en }}</span>
    </div>

    <div class="player-card__label-group">
      <div class="player-card__label" v-for="(label, i) in labels" :key="i">
        <label-component :label="label"/>
      </div>
    </div>
  </div>
</div>
</template>

<script>
// component import
import LabelComponent from '../label/LabelComponent';

export default {
  components: {
    LabelComponent
  },

  props: {
    player: {
      type: Object,
      default: null,
    }
  },

  data() {
    return {
      /**
       * LabelComponentに渡すデータ
       * @type {Array}
       */
      labels: [],
    }
  },

  created() {
    const player = this.player;

    // ポジションラベルのデータを作成。
    if (player.position) {
      this.labels.push(this.formatToLabel(player.position.color, player.position.name_ja));
    }

    /**
     * Labelに表示するタグを絞り込み
     * [主将, 主務, 副主将, 会計, 寮長]
     */
    const labelTagId = [2, 3, 4, 5, 6];
    labelTagId.forEach(id => {
      let tag = this.pickUpTag(id);
      if (tag) {
        this.labels.push(this.formatToLabel('darkblue', tag.name_ja));
      }
    })
  },

  methods: {
    /**
     * [モーダルを開ける]
     */
    open() {
      this.$emit('modal', this.player);
    },

    /**
     * ラベルコンポーネントに渡すオブジェクトを生成する。
     * @param1 {string} tag color
     * @param2 {string} tag text
     * @return {Object} ラベルコンポーネントに渡すオブジェクト
     */
    formatToLabel(color, text) {
      let data = {};
      data.color = color;
      data.text = text;
      return data;
    },

    /**
     * ラベルに出力するタグをIDで抽出する。
     * @param {Number} 抽出したいタグのid
     * @return {Object} tag object
     */
    pickUpTag(id) {
      return this.player.tags.find(el => {
        return (el.tag_id === id);
      })
    },

    /**
     * 画像のロードエラーハンドリング
     * デフォルトの画像パスに置き換える。
     */
    noImage(element) {
      element.target.src = '/image/noimage.png';
    }
  },
}
</script>

<style lang="scss">
.player-card {
  position: relative;
  cursor: pointer;
  border-radius: radius(hard);
  transition: transform .3s linear;

  @include hover {
    transform: scale(0.95);
  }

  &__figure {
    @include trimming(aspect(square));
    border-bottom: 2px solid color(darkblue);
    background-color: color(white);
  }

  &__information {
    background-color: color(lightgrey);
    padding: interval(1);
  }

  &__name {
    &-ja {
      display: block;
      margin-left: interval(.5);
    }
    &-en {
      @extend .player-card__name-ja;
      font-size: font(10);
    }
  }

  &__label-group {
    @include flex(row wrap);
    align-content: space-around;
    gap: interval(.5);
    margin-top: interval(1);
  }
}
</style>
