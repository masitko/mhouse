<template>
  <!-- <div class="box has-padding-medium raises-on-hover has-background-light">
    <p class="has-text-centered">
      <strong>{{ __('Please select:') }}</strong>
  </p>-->
  <card fixed :title="__('Please select:')" icon="sliders-h" :controls="2">
    <!-- <card-control slot="control-2">
    </card-control>-->
    <vue-select-filter
      source="wheels.wheels.options"
      :placeholder="__('Wheel Type')"
      v-model="filters.wheelId"
      @fetch="$emit('wheels-fetched', $event)"
    />
    <vue-select-filter
      source="administration.students.options"
      :placeholder="__('Select Student')"
      v-model="filters.userId"
      @fetch="$emit('users-fetched', $event)"
    />
    <vue-select-filter
      v-if="type!=='reports'"
      source="schools.terms.options"
      trackBy="id"
      :disabled="!options.history"
      :placeholder="__('Select Term')"
      v-model="filters.termId"
      @fetch="$emit('terms-fetched', $event)"
    />
    <vue-select-filter multiple
      v-if="type==='reports'"
      source="schools.terms.options"
      title="Terms"
      :placeholder="__('Select Terms')"
      v-model="filters.terms"
      @fetch="$emit('terms-fetched', $event)"
    />
    <vue-select-filter
      v-if="type==='reports'"
      trackBy="name"
      title="Chart Type"
      :disableClear="true"
      :options="chartTypes"
      v-model="filters.type"
    />
    <div v-if="type==='outcomes'" class="columns has-padding-medium is-desktop">
      <div class="column">
        <label class="label has-margin-top-medium">
          {{ __('Show Legend') }}
          <vue-switch class="has-margin-left-medium" v-model="filters.showLegend" size="is-small"/>
        </label>
      </div>
      <div class="column has-text-right">
        <button
          class="button"
          :class="[statuses[filters.status].class, { 'is-loading': options.loading }]"
          @click="save()"
          :disabled="!buttonEnabled"
        >
          <span>{{ statuses[filters.status].label }}</span>
          <span v-if="filters.status==='current'" class="icon">
            <fa icon="check"/>
          </span>
        </button>
      </div>
    </div>
    <!-- <div>{{buttonStatus}}</div> -->
  </card>
</template>

<script>
import Card from "../enso/bulma/Card.vue";
import CardControl from "../enso/bulma/CardControl.vue";
import VueSelectFilter from "../enso/select/VueSelectFilter.vue";
import VueSwitch from "../enso/vueforms/VueSwitch.vue";
import { faSlidersH } from "@fortawesome/free-solid-svg-icons";

export default {
  name: "FilterCard",

  components: {
    VueSelectFilter,
    VueSwitch,
    Card,
    CardControl
  },

  props: {
    filters: {
      type: Object,
      default: () => ({})
    },
    options: {
      type: Object,
      default: () => ({})
    },
    type: {
      type: String,
      default: () => ('outcomes')
    }
  },

  data() {
    return {
      chartTypes: [
        { name: 'Bars' },
        { name: 'Lines' },
        { name: 'Radar' },
        ],
      statuses: {
        changed: {
          label: "Data changed...",
          class: 'is-warning'
        },
        current: {
          label: "Up to date",
          class: 'is-success'
        }
      }
    };
  },

  computed: {
    buttonEnabled() {
      return this.filters.termId && this.filters.userId && this.filters.wheelId && this.filters.unsaved;
    }
  },
  methods: {
    save() {
      console.log("EMITING SAVE");
      this.$emit("save");
    },
  }
};
</script>
