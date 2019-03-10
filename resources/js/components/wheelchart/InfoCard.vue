<template>
  <!-- <div class="box has-padding-medium raises-on-hover has-background-light">
    <p class="has-text-centered">
      <strong>{{ __('Please select:') }}</strong>
  </p>-->
  <card 
    :title="__('Info:')" 
    icon="info-circle" 
    :controls="2"
    >
    <card-control slot="control-2">
    </card-control>

  <p v-if="infos.record">
    <strong>Observation: </strong>{{infos.record.name}}
  </p>
  <p v-if="infos.outcome">
    <strong>Outcome: </strong>{{getOutcome(infos.outcome).label}}
  </p>
  </card>
  <!-- </div> -->
</template>

<script>
import Card from "../enso/bulma/Card.vue";
import CardControl from "../enso/bulma/CardControl.vue";
import VueSelectFilter from "../enso/select/VueSelectFilter.vue";
import VueSwitch from "../enso/vueforms/VueSwitch.vue";
import Outcomes from "./outcomes.js";
import { faInfoCircle } from "@fortawesome/free-solid-svg-icons";


export default {
  name: "InfoCard",

  components: {
    VueSelectFilter,
    VueSwitch,
    Card,
    CardControl
  },

  props: {
    infos: {
      type: Object,
    },
  },
  methods: {
    getOutcome(colour) {
      return Outcomes.find(
        (outcome) => outcome.colour === colour
        );
    }
  }
};
</script>
