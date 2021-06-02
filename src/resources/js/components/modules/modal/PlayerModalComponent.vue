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
        <table-component :table="table"/>
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
       * デーブルデータ
       * @type {Array}
       */
      table: null,
    }
  },

  created() {
    const player = this.player;
    let records = [
      this.createTableBody('学年', `${player.grade}年生`),
      this.createTableBody('所属学部', `${player.affiliation}学部`),
      this.createTableBody('ポジション', player.position.name_ja),
      this.createTableBody('出身校', player.alma_mater),
      this.createTableBody('出身地', player.prefecture.name_ja),
      this.createTableBody('実績', player.achievement),
    ];
    this.table = this.createTableData(null, records);
  },

  methods: {
    /**
     * [モーダルを閉じる]
     * 親コンポーネントのメソッドを使う。
     */
    close() {
      this.$emit('close');
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
