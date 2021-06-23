<template>
  <user-modal :user="activeAlumni" @close="close">
    <template v-slot:thumbnail>
      <user-thumbnail :image="activeAlumni.img" :borderColor='activeAlumni.position.color'/>
    </template>

    <template v-slot:tag>
      <div class="active-alumni-modal__tag" v-for="(tag, i) in tags" :key="i">
        <tag :tag="tag"/>
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
import Tag from '../Tag/TagComponent';
import TableComponent from '../table/TableComponent';

export default {
  components: {
    UserModal,
    UserThumbnail,
    Tag,
    TableComponent,
  },

  props: {
    activeAlumni: {
      type: Object,
      required: true,
    },

    /**
     * タグデータ
     * @type {Array}
     */
    tags: {
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
  &__tag {
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
