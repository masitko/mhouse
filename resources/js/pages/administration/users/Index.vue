<template>
  <vue-table class="box is-paddingless raises-on-hover is-rounded" :path="getPath()" id="users">
    <figure class="image is-24x24 avatar" slot="avatarId" slot-scope="{ row }">
      <img class="is-rounded" :src="avatarLink(row.avatarId)" v-if="row.avatarId">
    </figure>
  </vue-table>
</template>

<script>
import VueTable from "../../../components/enso/vuedatatable/VueTable.vue";

export default {
  components: { VueTable },
  created() {
    console.log(this.$route);
    this.prefix = this.$route.meta.prefix;
  },
  computed: {
    // path: route(this.$route.meta.prefix + ".initTable")

  },
  data: () => ({
  }),

  methods: {
    getPath() {
      let path = this.$route.name.split('.');
      path.pop();
      let prefix = path.join('.')      
      return route(prefix + ".initTable");
    },
    avatarLink(id) {
      return route("core.avatars.show", id);
    }
  }
};
</script>

<style lang="scss" scoped>
.avatar {
  margin: auto;
}
</style>

