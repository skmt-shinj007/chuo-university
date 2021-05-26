<template>
  <user-modal :user="staff" @close="close">
    <template v-slot:thumbnail>
      <user-thumbnail :image="staff.img"/>
    </template>

    <template v-slot:label>
      <div class="staff-modal__label" v-for="(label, i) in labels" :key="i">
        <label-component :label="label"/>
      </div>
    </template>

    <template v-slot:content>
      <div class="staff-modal__lists">
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
    staff: {
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
    const staff = this.staff;
    if (staff.graduate_date) this.pushList('卒業年', `${staff.graduate_date}年卒業`);
    if (staff.affiliation) this.pushList('所属', staff.affiliation);
    if (staff.achivement) this.pushList('実績', staff.achivement);
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
.staff-modal {
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
