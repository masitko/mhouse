<template>
  <div class="wrapper">
    <div class="columns">
      <div class="column is-three-quarters">
        <div class="animated fadeIn">
          <chart-card
            class="is-rounded has-background-light raises-on-hover has-margin-bottom-large"
            :wheel-data="wheelData"
            :outcomes="outcomes"
            :title="title"
            :show-legend="filters.showLegend"
            :disabled="!wheelEnabled"
            @change="chartChange"
          />
        </div>
      </div>
      <div class="column is-one-quarter">
        <filter-card
          class="is-rounded has-background-light raises-on-hover has-margin-bottom-large has-padding-medium"
          :filters="filters"
          :options="options"
          @save="save"
          @users-fetched="usersFetched"
          @terms-fetched="termsFetched"
        />
        <info-card
          class="is-rounded has-background-light raises-on-hover has-margin-bottom-large has-padding-medium"
          :infos="infos"
        />
        <legend-card
          class="is-rounded has-background-light raises-on-hover has-margin-bottom-large has-padding-medium"
       />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faSpinner } from "@fortawesome/free-solid-svg-icons";
import ChartCard from "../../../components/wheelchart/ChartCard.vue";
import FilterCard from "../../../components/wheelchart/FilterCard.vue";
import InfoCard from "../../../components/wheelchart/InfoCard.vue";
import LegendCard from "../../../components/wheelchart/LegendCard.vue";

library.add(faSpinner);

export default {
  components: {
    ChartCard,
    FilterCard,
    InfoCard,
    LegendCard,
  },

  data: () => ({
    ready: false,
    // loading: false,
    axiosRequest: null,
    timeout: null,
    feed: [],
    title: '',
    offset: 0,
    filters: {
      userId: null,
      termId: null,
      wheelId: null,
      unsaved: false, // needs saving if set to true
      status: 'current',
      showLegend: false
    },
    options: {
      loading: false
    },
    infos: {
    },
    wheelData: {},
    outcomes: {}
  }),

  computed: {
    wheelEnabled() {
      // console.log('COMPUTED UPDATED!!!');
      return this.filters.userId && this.filters.termId && this.filters.wheelId;
    },
    ...mapGetters("preferences", { locale: "lang" })
  },

  watch: {
    "filters.wheelId": {
      handler() {
        this.fetch(true);
      }
    },
    "filters.userId": {
      handler() {
        this.fetch(false);
        this.updateTitle();
      }
    },
    "filters.termId": {
      handler() {
        this.fetch(false);
        this.updateTitle();
      }
    }
  },

  methods: {
    chartChange(values) {
      this.infos = values;
      if( values.type === 'click') {
        // console.log("CHART CLICKED!!!");
        // console.log( values );
        this.filters.status = 'changed';
        clearTimeout(this.timeout);
        this.timeout = setTimeout(this.save, 1000);
      }
    },
    save() {
      // console.log("SAVING!");
      axios
        .post(route("schools.outcomes.storeWheel"), {
          outcomes: this.outcomes,
          term_id: this.filters.termId,
          user_id: this.filters.userId,
          wheel_id: this.filters.wheelId
          // params: { filters: this.filters },
          // cancelToken: this.axiosRequest.token
        })
        .then(response => {
          // this.filters.unsaved = false;
          this.filters.status = 'current';
          // console.log(response);
        })
        .catch(error => {
          this.options.loading = false;
          if (axios.isCancel(error)) {
            this.axiosRequest = null;
            return;
          }
          this.handleError(error);
        });
    },
    usersFetched( users ) {
      // console.log('USERS!', users);
      this.users = users;
    },
    termsFetched( terms ) {
      console.log('TERMS!',terms);
      // this.terms = terms;
    },
    updateTitle() {
      this.title = "" ;
      this.title += this.filters.wheelId?this.wheelData.name:'';
      this.title += this.filters.userId? ' - ' + this.users.filter(user=>user.id === this.filters.userId)[0].name:'';
      this.title += this.filters.termId? ' - ' + this.terms.filter(term=>term.id === this.filters.termId)[0].name:'';
    },
    fetch(includeWheel = false) {
      this.filters.status = 'current';
      // this.filters.unsaved = false;
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
