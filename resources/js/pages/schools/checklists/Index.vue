<template>
  <div class="wrapper">
    <div class="columns">
      <div class="column is-three-quarters">
        <div class="animated fadeIn">
          <vue-table
            class="box has-background-light is-paddingless raises-on-hover is-rounded"
            :path="path"
            :pivot-params="pivotParams"
            id="checklist"
          />
        </div>
      </div>
      <div class="column is-one-quarter">
        <filter-card
          class="is-rounded has-background-light raises-on-hover has-margin-bottom-large has-padding-medium"
          :filters="filters"
          :options="options"
          type="checklists"
          @save="save"
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

import VueTable from "../../../components/enso/vuedatatable/VueTable.vue";

import isWithinInterval from "date-fns/isWithinInterval";

library.add(faSpinner);

export default {
  components: {
    VueTable,
    FilterCard
  },

  data: () => ({
    path: route("schools.checklists.initTable"),
    // ready: false,
    // loading: false,
    // axiosRequest: null,
    // timeout: null,
    // feed: [],
    // title: "",
    // offset: 0,
    filters: {
      userId: null,
      wheelId: null,
      termId: null,
      unsaved: false, // needs saving if set to true
      // status: "current",
      // showLegend: false
    },
    options: {
      loading: false,
      history: true,
    },
    pivotParams: {
      area: {
        id: []
      },
      user: {
        id: null
      },
      term: {
        id: null
      },
      wheel: {
        id: null
      },
    },
    infos: {},
    wheelData: {},
    outcomes: {}
  }),

  // created() {
  //   this.options.history = this.$route.meta.history;
  //   // this.name = this.name+this.options.history;
  //   // console.log(this);
  // },

  watch: {
    "filters.wheelId": {
      handler() {
        this.pivotParams.wheel.id = this.filters.wheelId;
        this.wheelChange();
      }
    },
    "filters.userId": {
      handler() {
        this.pivotParams.user.id = this.filters.userId;
      }
    },
    "filters.termId": {
      handler() {
        this.pivotParams.term.id = this.filters.termId;
      }
    }
  },

  methods: {
    save() {},
    wheelChange() {
      if (this.filters.wheelId) {
        let def = JSON.parse(
          this.wheels.find(wheel => wheel.id === this.filters.wheelId)
            .definition
        );
        console.log(def);
        if (def && def.areas) this.pivotParams.area.id = def.areas;
      } else {
        this.pivotParams.area.id = [];
      }
    },
    // chartChange(values) {
    //   this.infos = values;
    //   if (values.type === "click") {
    //     // console.log("CHART CLICKED!!!");
    //     // console.log( values );
    //     this.filters.status = "changed";
    //     clearTimeout(this.timeout);
    //     this.timeout = setTimeout(this.save, 1000);
    //   }
    // },
    wheelsFetched(wheels) {
      // console.log("Wheels fetched!", wheels);
      this.wheels = wheels;
    },
    usersFetched(users) {
      // console.log('USERS!', users);
      this.users = users;
    },
    termsFetched(terms) {
      // console.log("TERMS!", terms);
      terms.forEach(term => {
        if (
          isWithinInterval(new Date(), {
            start: new Date(term.start_date),
            end: new Date(term.end_date)
          }) === true
        ) {
          this.filters.termId = term.id;
        }
        if (!this.options.history && !this.filters.termId) {
          console.log("NO CURRENT TERM!!!");
          this.filters.termId = 99999;
          terms.push({
            id: this.filters.termId,
            name: "No active term!"
          });
        }
      });
    },
    // updateTitle() {
    //   this.title = "";
    //   this.title += this.filters.wheelId ? this.wheelData.name : "";
    //   this.title +=
    //     this.filters.userId && this.users
    //       ? " - " +
    //         this.users.filter(user => user.id === this.filters.userId)[0].name
    //       : "";
    //   this.title +=
    //     this.filters.termId && this.terms
    //       ? " - " +
    //         this.terms.filter(term => term.id === this.filters.termId)[0].name
    //       : "";
    // },
    // fetch() {},
    // processData(data) {
    //   // console.log(data);
    //   this.options.loading = false;
    //   if (typeof data.wheel !== "undefined") {
    //     this.wheelData = data.wheel;
    //     this.outcomes = {};
    //     // this.wheelData.outcomes = this.outcomes;
    //   }
    //   if (typeof data.outcomeRec !== "undefined") {
    //     // console.log("UPDATING OUTCOMES!!!");
    //     this.outcomes = data.outcomeRec.outcomes;
    //     // this.wheelData.outcomes = this.outcomes;
    //     this.wheelData.observations.forEach(observation => {
    //       if (typeof this.outcomes[observation.id] === "undefined") {
    //         this.outcomes[observation.id] = 0;
    //       }
    //     });
    //   }
    //   this.updateTitle();
    // }
  }
};
</script>

<style lang="scss">
</style>
