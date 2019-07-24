<template>
  <div class="wrapper">
    <div class="columns">
      <div class="column is-three-quarters">
        <div class="animated fadeIn">
          <vue-table
            class="box has-background-light is-paddingless raises-on-hover is-rounded"
            :path="path"
            :pivot-params="pivotParams"
            :init-params="initParams"
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
    // path: ,
    filters: {
      userId: null,
      wheelId: null,
      // termId: null,
      terms: [],
    },
    options: {
      loading: false,
      history: true
    },
    pivotParams: {
      area: {
        id: []
      },
      user: {
        id: null
      },
      // term: {
      //   id: null
      // },
      wheel: {
        id: null
      },
      terms: {
        id: []
      },
      exportFileName: null
    },
    infos: {},
    wheelData: {},
    outcomes: {}
  }),
  computed: {
    path() {
      return route("schools.checklists.initTable");
    },
    initParams() {
      this.pivotParams.terms.id = this.filters.terms;
      return {
        terms: this.filters.terms
      }
    }
  },
  watch: {
    "filters.wheelId": {
      handler() {
        this.pivotParams.wheel.id = this.filters.wheelId;
        this.wheelChange();
        this.updateFileName();
      }
    },
    "filters.userId": {
      handler() {
        this.pivotParams.user.id = this.filters.userId;
        this.updateFileName();
      }
    },
    // "filters.termId": {
    //   handler() {
    //     this.pivotParams.term.id = this.filters.termId;
    //     this.updateFileName();
    //   }
    // },
    // "filters.terms": {
    //   handler() {
    //     this.pivotParams.terms.id = this.filters.terms;
    //     this.updateFileName();
    //   }
    // }
  },

  methods: {
    save() {},
    wheelChange() {
      if (this.filters.wheelId) {
        let def = JSON.parse(
          this.wheels.find(wheel => wheel.id === this.filters.wheelId)
            .definition
        );
        if (def && def.areas) this.pivotParams.area.id = def.areas;
      } else {
        this.pivotParams.area.id = [];
      }
    },
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
      terms.forEach((term, idx) => {
        if (idx < 3)
          // default amount of past terms to include in the reports
          this.filters.terms.push(term.id);
      });

      this.terms = terms;
    },
    updateFileName() {
      this.pivotParams.exportFileName = "Checklist";
      this.pivotParams.exportFileName +=
        this.pivotParams.user.id && this.users
          ? " " +
            this.users.filter(user => user.id === this.pivotParams.user.id)[0]
              .name
          : "";
      this.pivotParams.exportFileName +=
        this.pivotParams.wheel.id && this.wheels
          ? " " +
            this.wheels.filter(
              wheel => wheel.id === this.pivotParams.wheel.id
            )[0].name
          : "";
      // this.pivotParams.exportFileName +=
      //   this.pivotParams.term.id && this.terms
      //     ? " " +
      //       this.terms.filter(term => term.id === this.pivotParams.term.id)[0]
      //         .name
      //     : "";
    }
  }
};
</script>

<style lang="scss">
</style>
