<template>
  <user-modal :user="player" @close="close">
    <template v-slot:thumbnail>
      <user-thumbnail :image="player.img" :borderColor='player.position.color'/>
    </template>

    <template v-slot:label>
      <div class="player-modal__label" v-for="(label, i) in labels" :key="i">
        <label-component :label="label"/>
      </div>
    </template>

    <template v-slot:content>
      <div class="player-modal__lists">
        <table-component :tableItems="lists"/>
      </div>
    </template>
  </user-modal>
</template>

<script>
// component import
import UserModal from './UserModalFrameComponent';
import UserThumbnail from '../UserThumbnailComponent';
import LabelComponent from '../label/LabelComponent';
import TableComponent from '../table/TableComponent';

export default {
  components: {
    UserModal,
    UserThumbnail,
    LabelComponent,
    TableComponent,
  },

  props: {
    player: {
      type: Object,
      required: true,
    },

    /**
     * labelデータ
     * @type {Array}
     */
    labels: {
      type: Array,
      default: null,
    },
  },

  data() {
    return {
      /**
       * リストのデーブルデータ
       * @type {Array}
       */
      lists: [],
    }
  },

  created() {
    const player = this.player;
    console.log(player);
    this.pushList('学年', `${player.grade}年生`);
    this.pushList('所属学部', player.affiliation);
    this.pushList('ポジション', player.position.name_ja);
    this.pushList('出身校', player.alma_mater);
    this.pushList('出身地', player.prefecture.name_ja);
    this.pushList('実績', player.achievement);
  },

  methods: {
    /**
     * [モーダルを閉じる]
     * 親コンポーネントのメソッドを使う。
     */
    close() {
      this.$emit('close');
    },

    /**
     * テーブルのデータを作成する
     * @param {String} key テーブルの左辺に該当する文字列
     * @param {String} value テーブルの右辺に該当する文字列
     */
    pushList(key, value) {
      this.lists.push({
        key: key,
        value: value,
      });
    },
  },
}
</script>

<style lang="scss" scoped>
.player-modal {
  &__label {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }

  &__lists {
    padding: interval(5) 0;
  }
}

</style>
