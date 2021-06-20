<template>
  <user-modal :user="activeAlumni" @close="close">
    <template v-slot:thumbnail>
      <user-thumbnail :image="activeAlumni.img" :borderColor='activeAlumni.position.color'/>
    </template>

    <template v-slot:label>
      <div class="active-alumni-modal__label" v-for="(label, i) in labels" :key="i">
        <label-component :label="label"/>
      </div>
    </template>

    <template v-slot:content>
      <div class="active-alumni-modal__lists">
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
    activeAlumni: {
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
    const activeAlumni = this.activeAlumni;
    let records = [];
    if (activeAlumni.affiliation) records.push(this.createTableBody('所属', activeAlumni.affiliation));
    if (activeAlumni.position) records.push(this.createTableBody('ポジション', activeAlumni.position.name_ja));
    if (activeAlumni.alma_mater) records.push(this.createTableBody('出身校', activeAlumni.alma_mater));
    if (activeAlumni.affiliation) records.push(this.createTableBody('出身地', activeAlumni.prefecture.name_ja));
    records.push(this.createTableBody('実績', activeAlumni.achievement));
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
.active-alumni-modal {
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
