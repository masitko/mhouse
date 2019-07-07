<template>
  <div class="wrapper">
    <div class="columns">
      <div class="column is-three-quarters">
        <div class="animated fadeIn">
    <div class="columns is-multiline">
        <div class="column is-one-third">
            <chart-card class="
                    is-rounded has-background-light raises-on-hover
                    has-margin-bottom-large
                "
                source="/api/dashboard/pie"/>
            <chart-card class="
                    is-rounded has-background-light raises-on-hover
                    has-margin-bottom-large
                "
                source="/api/dashboard/polar"/>
        </div>
        <div class="column is-one-third">
            <chart-card class="
                    is-rounded has-background-light raises-on-hover
                    has-margin-bottom-large
                "
                source="/api/dashboard/bar"/>
            <chart-card class="
                    is-rounded has-background-light raises-on-hover
                    has-margin-bottom-large
                "
                source="/api/dashboard/bubble"/>
            <chart-card class="
                    is-rounded has-background-light raises-on-hover
                    has-margin-bottom-large
                "
                source="/api/dashboard/line"/>
        </div>
        <div class="column is-one-third">
            <chart-card class="
                    is-rounded has-background-light raises-on-hover
                    has-margin-bottom-large
                "
                source="/api/dashboard/radar"/>
            <chart-card class="
                    is-rounded has-background-light raises-on-hover
                    has-margin-bottom-large
                "
                source="/api/dashboard/doughnut"/>
        </div>
    </div>
          <!-- <vue-table
            class="box has-background-light is-paddingless raises-on-hover is-rounded"
            :path="path"
            :pivot-params="pivotParams"
            id="checklist"
          /> -->
        </div>
      </div>
      <div class="column is-one-quarter">
        <filter-card
          class="is-rounded has-background-light raises-on-hover has-margin-bottom-large has-padding-medium"
          :filters="filters"
          :options="options"
          type="reports"
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
import ChartCard from '../../../components/enso/charts/ChartCard.vue';

import isWithinInterval from "date-fns/isWithinInterval";

library.add(faSpinner);

export default {
  components: {
    ChartCard,
    FilterCard
  },

  data: () => ({
    ready: false,
    axiosRequest: null,
    feed: [],
    filters: {
      wheelId: null,
      userId: null,
      terms: [],
    },
    options: {
      loading: false,
    },
    infos: {},
    wheelData: {},
    outcomes: {}
  }),

  created() {
    // console.log(this);
  },

  watch: {
    "filters.wheelId": {
      handler() {
        this.fetch(true);
      }
    },
    "filters.userId": {
      handler() {
        this.fetch();
      }
    },
    "filters.termId": {
      handler() {
        this.fetch();
      }
    }
  },

  methods: {
    wheelsFetched(wheels) {
      this.wheels = wheels;
    },
    usersFetched(users) {
      // console.log('USERS!', users);
      this.users = users;
    },
    termsFetched(terms) {
      console.log("TERMS!", terms);

      terms.forEach((term, idx) => {
        if( idx < 2 ) // default amount of past terms to include in the reports
          this.filters.terms.push(term.id);
      });
    },
    updateTitle() {
      this.title = "";
      this.title += this.filters.wheelId ? this.wheelData.name : "";
      this.title +=
        this.filters.userId && this.users
          ? " - " +
            this.users.filter(user => user.id === this.filters.userId)[0].name
          : "";
      this.title +=
        this.filters.termId && this.terms
          ? " - " +
            this.terms.filter(term => term.id === this.filters.termId)[0].name
          : "";
    },
    fetch(includeWheel = false) {
      if (!this.filters.wheelId && includeWheel) {
        this.wheelData = {};
        return;
      }
      if (!this.filters.userId || !this.filters.termId) {
        if (!includeWheel) {
          this.outcomes = {};
          return;
        }
      }
      this.filters.includeWheel = includeWheel;
      this.options.loading = true;
      if (this.axiosRequest) {
        this.axiosRequest.cancel();
      }
      this.axiosRequest = axios.CancelToken.source();
      axios
        .get(route("schools.outcomes.getWheel"), {
          params: { filters: this.filters },
          cancelToken: this.axiosRequest.token
        })
        .then(({ data }) => this.processData(data))
        .catch(error => {
          this.options.loading = false;
          if (axios.isCancel(error)) {
            this.axiosRequest = null;
            return;
          }
          this.handleError(error);
        });
    },
    processData(data) {
      // console.log(data);
      this.options.loading = false;
      if (typeof data.wheel !== "undefined") {
        this.wheelData = data.wheel;
        this.outcomes = {};
        // this.wheelData.outcomes = this.outcomes;
      }
      if (typeof data.outcomeRec !== "undefined") {
        // console.log("UPDATING OUTCOMES!!!");
        this.outcomes = data.outcomeRec.outcomes;
        // this.wheelData.outcomes = this.outcomes;
        this.wheelData.observations.forEach(observation => {
          if (typeof this.outcomes[observation.id] === "undefined") {
            this.outcomes[observation.id] = 0;
          }
        });
      }
      this.updateTitle();
    }
  }
};
</script>

<style lang="scss">
</style>
