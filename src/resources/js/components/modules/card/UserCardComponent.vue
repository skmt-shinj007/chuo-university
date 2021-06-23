<template>
  <div class="user-card" @click="openModal">
    <figure class="user-card__figure">
      <img :src="user.img.src" :alt="user.img.alt" @error="noImage">
    </figure>

    <div class="user-card__information">
      <div class="user-card__name">
        <span class="user-card__name-ja">{{ user.name_ja }}</span>
        <span class="user-card__name-en">{{ user.name_en }}</span>
      </div>

      <div class="user-card__tag-group">
        <div class="user-card__tag" v-for="(tag, i) in tags" :key="i">
          <tag :tag="tag"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// component import
import Tag from '../tag/TagComponent';

import { viewData } from '../../../config/data/viewdata';

export default {
  components: {
    Tag,
  },

  props: {
    // ユーザーオブジェクト
    user: {
      type: Object,
      default: null,
    },

    // カードに表示するタグのID
    showTagIds: {
      type: Array,
      default: []
    }
  },

  data() {
    return {
      /**
       * カードに表示させるタグ
       * @type {Array}
       */
      tags: [],
    }
  },

  created() {
    const user = this.user;

    // ポジションラベルのデータを作成。
    if (user.position) {
      this.tags.push(this.formatTag(user.position.color, user.position.name_ja));
    }

    /**
     * カードに表示するタグをidで絞り込む
     */
    this.showTagIds.forEach(id => {
      let tag = this.pickUpTag(id);
      if (tag) {
        this.tags.push(this.formatTag('darkblue', tag.name_ja));
      }
    })
  },

  methods: {
    // モーダルを開ける
    openModal() {
      this.$emit('open', this.user, this.tags);
    },

    /**
     * ラベルに出力するタグをIDで抽出する。
     * @param {Number} 抽出したいタグのid
     * @return {Object} tag object
     */
    pickUpTag(id) {
      return this.user.tags.find(el => {
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

<style lang="scss" scoped>
.user-card {
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
      @extend .user-card__name-ja;
      font-size: font(10);
    }
  }

  &__tag-group {
    @include flex(row wrap);
    align-content: space-around;
    gap: interval(.5);
    margin-top: interval(1);
  }
}
</style>
