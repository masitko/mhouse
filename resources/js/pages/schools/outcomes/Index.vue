<template>
  <div class="wrapper">
    <div class="columns is-reverse-mobile">
      <div class="column is-three-quarters">
        <!-- v-if="wheelData" -->
        <div class="animated fadeIn is-half">
          <chart-card
            class="is-rounded has-background-light raises-on-hover has-margin-bottom-large"
            :wheel-data="wheelData"
            :outcomes="outcomes"
            :title="wheelData.name"
          />
        </div>
      </div>
      <div class="column is-one-quarter">
        <div class="box has-padding-medium raises-on-hover has-background-light">
          <p class="has-text-centered">
            <strong>{{ __('Please select:') }}</strong>
          </p>
          <vue-select-filter
            source="wheels.wheels.options"
            :placeholder="__('Wheel Type')"
            v-model="filters.wheelId"
          />
          <vue-select-filter
            source="administration.users.options"
            :placeholder="__('Select Student')"
            v-model="filters.userId"
          />
          <vue-select-filter
            source="schools.terms.options"
            :placeholder="__('Select Term')"
            v-model="filters.termId"
          />
          <vue-switch
            source="schools.terms.options"
            label="Show Legend"
            v-model="filters.showLegend"
          />

                    <!-- <div class="column">
                        <label class="label">
                            {{ __('Only missing') }}
                            <vue-switch class="has-margin-left-medium"
                                v-model="filterMissing"
                                size="is-large"/>
                        </label>
                    </div> -->

          <p class="has-text-centered">
            <button
              class="button is-success"
              :class="{ 'is-loading': loading }"
              @click="save()"
              :disabled="!(filters.termId && filters.userId && filters.wheelId)"
            >
              <span>{{ __('Save') }}</span>
              <span class="icon">
                <fa icon="check"/>
              </span>
            </button>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faSpinner } from "@fortawesome/free-solid-svg-icons";
import VueSelectFilter from "../../../components/enso/select/VueSelectFilter.vue";
import VueSwitch from '../../../components/enso/vueforms/VueSwitch.vue';
import ChartCard from "../../../components/wheelchart/ChartCard.vue";

library.add(faSpinner);

export default {
  components: {
    VueSelectFilter,
    VueSwitch,
    ChartCard
  },

  data: () => ({
    ready: false,
    loading: false,
    axiosRequest: null,
    feed: [],
    offset: 0,
    filters: {
      userId: null,
      termId: null,
      wheelId: null,
      showLegend: false,
    },
    wheelData: {},
    outcomes: {}
  }),

  computed: {
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
      }
    },
    "filters.termId": {
      handler() {
        this.fetch(false);
      }
    }
  },

  methods: {
    save() {
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
          console.log(response);
        })
        .catch(error => {
          this.loading = false;
          if (axios.isCancel(error)) {
            this.axiosRequest = null;
            return;
          }
          this.handleError(error);
        });
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
      this.loading = true;
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
          this.loading = false;
          if (axios.isCancel(error)) {
            this.axiosRequest = null;
            return;
          }
          this.handleError(error);
        });
    },
    processData(data) {
      console.log(data);
      this.loading = false;
      if (typeof data.wheel !== "undefined") {
        this.wheelData = data.wheel;
        this.outcomes = {};
        // this.wheelData.outcomes = this.outcomes;
      }
      if (typeof data.outcomeRec !== "undefined") {
        console.log("UPDATING OUTCOMES!!!");
        this.outcomes = data.outcomeRec.outcomes;
        // this.wheelData.outcomes = this.outcomes;
        this.wheelData.observations.forEach(observation => {
          if (typeof this.outcomes[observation.id] === "undefined") {
            this.outcomes[observation.id] = 0;
          }
        });
      }
    }
  }
};
</script>

<style lang="scss">
</style>
