<template>
  <div class="wrapper">
    <div class="has-text-centered" v-if="!ready && loading">
      <h4 class="title is-4 has-text-centered">
        {{ __('Loading') }}
        <span class="icon is-small has-margin-left-medium">
          <fa icon="spinner" size="xs" spin/>
        </span>
      </h4>
    </div>
    <div class="columns is-reverse-mobile">
      <div class="column is-three-quarters">
        {{filters}}
        <div class="animated fadeIn is-half">
          <chart-card
            class="is-rounded has-background-light raises-on-hover has-margin-bottom-large"
            :wheel-data="wheelData"
          />
        </div>

        <!-- <timeline class="raises-on-hover"
                    :feed="feed"
                    :loading="loading"
        @load-more="fetch()"/>-->
      </div>
      <div class="column is-one-quarter">
        <button class="button is-fullwidth" :class="{ 'is-loading': loading }" @click="reload()">
          <span>{{ __('') }}</span>
          <span class="icon">
            <fa icon="sync-alt"/>
          </span>
        </button>
        <!-- <date-filter class="box raises-on-hover has-margin-top-large"
                    :locale="locale"
        @update="filters.interval = $event"/>-->
        <div class="box has-padding-medium raises-on-hover has-background-light">
          <p class="has-text-centered">
            <strong>{{ __('What') }}</strong>
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
            label="name"
            :placeholder="__('Select Term')"
            v-model="filters.termId"
          />
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
import ChartCard from "../../../components/wheelchart/ChartCard.vue";

library.add(faSpinner);

export default {
  components: {
    VueSelectFilter, ChartCard
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
      wheelId: null
    },
    wheelData: {

    }
  }),

  computed: {
    ...mapGetters("preferences", { locale: "lang" })
  },

  watch: {
    filters: {
      handler() {
        this.reload();
      },
      deep: true
    }
  },

  methods: {
    fetch() {
      if (!this.filters.userId || !this.filters.termId || !this.filters.wheelId)
        return;
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
        .then(({ data }) => {
          this.loading = false;
          if( data.wheel ) {
            wheelData.areas = data.wheel.areas;
            wheelData.observations = data.wheel.observations;
          }

          console.log(data);
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
    reload() {
      this.fetch();
    },
  }
};
</script>

<style lang="scss">
</style>
