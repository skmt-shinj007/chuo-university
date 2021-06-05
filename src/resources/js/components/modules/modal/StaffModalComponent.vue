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
       * デーブルデータ
       * @type {Array}
       */
      table: null,
    }
  },

  created() {
    const staff = this.staff;
    let records = [];
    if (staff.graduate_date) {
      records.push(this.createTableBody('卒業年', `${staff.graduate_date}年卒業`));
    }
    if (staff.affiliation) {
      records.push(this.createTableBody('所属', staff.affiliation));
    }
    if (staff.achievement) {
      records.push(this.createTableBody('実績', staff.achievement));
    }

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
