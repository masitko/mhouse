<template>
  <div class="wrapper">
    <div class="columns">
      <div class="column is-three-quarters">
        <div class="animated fadeIn">
          <vue-table
            class="box has-background-light is-paddingless raises-on-hover is-rounded"
            :path="path"
            :pivot-params="params.filters"
            id="export"
          >
            <figure class="image is-24x24 avatar" slot="avatarId" slot-scope="{ row }">
              <img class="is-rounded" :src="avatarLink(row.avatarId)" v-if="row.avatarId" />
            </figure>
          </vue-table>
        </div>
      </div>
      <div class="column is-one-quarter">
        <filter-card
          class="is-rounded has-background-light raises-on-hover has-margin-bottom-large has-padding-medium"
          :filters="params.filters"
          :options="options"
          type="exports"
          @users-fetched="usersFetched"
          @terms-fetched="termsFetched"
          @wheels-fetched="wheelsFetched"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faSpinner } from "@fortawesome/free-solid-svg-icons";
import FilterCard from "../../../components/wheelchart/FilterCard.vue";
import ChartCard from "../../../components/enso/charts/ChartCard.vue";

import VueTable from "../../../components/enso/vuedatatable/VueTable.vue";

import isWithinInterval from "date-fns/isWithinInterval";

library.add(faSpinner);

export default {
  components: {
    VueTable,
    FilterCard
  },

  data: () => ({
    // ready: false,
    axiosRequest: null,
    feed: [],
    params: {
      filters: {
        wheelId: null,
        termId: null,
        ageGroups: [],
        areas: [],
        exportFileName: null
      }
    },
    options: {
      loading: false,
      history: true
    },
    infos: {},
    wheelData: {},
    outcomes: {}
  }),

  watch: {
    "params.filters.wheelId": {
      handler() {
        this.wheelChange();
        this.updateFileName();
      }
    },
    "params.filters.termId": {
      handler() {
        this.updateFileName();
      }
    }
  },

  computed: {
    ready() {
      console.log("FILTERS CHANGE!!!");
      return (
        this.params.filters.wheelId &&
        this.params.filters.userId &&
        this.params.filters.terms.length
      );
    },
    path() {
      return route("schools.exports.initTable");
    }
  },

  created() {
    // console.log(this);
  },

  methods: {
    wheelChange() {
      if (this.params.filters.wheelId) {
        let def = JSON.parse(
          this.wheels.find(wheel => wheel.id === this.params.filters.wheelId)
            .definition
        );
        if (def && def.areas) this.params.filters.areas = def.areas;
      } else {
        this.params.filters.areas = [];
      }
    },
    wheelsFetched(wheels) {
      this.wheels = wheels;
    },
    usersFetched(users) {
      // console.log('USERS!', users);
      this.users = users;
    },
    termsFetched(terms) {
      terms.forEach(term => {
        if (
          isWithinInterval(new Date(), {
            start: new Date(term.start_date),
            end: new Date(term.end_date)
          }) === true
        ) {
          this.params.filters.termId = term.id;
        }
        if (!this.options.history && !this.filters.termId) {
          console.log("NO CURRENT TERM!!!");
          this.params.filters.termId = 99999;
          terms.push({
            id: this.filters.termId,
            name: "No active term!"
          });
        }
      });
      this.terms = terms;
    },
    updateFileName() {
      this.params.filters.exportFileName = "Outcomes Export";
      this.params.filters.exportFileName +=
        this.params.filters.wheelId && this.wheels
          ? " " +
            this.wheels.filter(
              wheel => wheel.id === this.params.filters.wheelId
            )[0].name
          : "";
      // this.params.filters.exportFileName +=
      //   this.params.filters.userId && this.users
      //     ? " - " +
      //       this.users.filter(user => user.id === this.params.filters.userId)[0].name
      //     : "";
      this.params.filters.exportFileName +=
        this.params.filters.termId && this.terms
          ? " " +
            this.terms.filter(term => term.id === this.params.filters.termId)[0]
              .name
          : "";
    },
    avatarLink(id) {
      return route("core.avatars.show", id);
    }
  }
};
</script>

<style lang="scss">
</style>
