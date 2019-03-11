<template>
  <card fixed :title="__('Info:')" icon="info-circle" :controls="2" class="has-padding-medium">
    <!-- <card-control slot="control-2">
    </card-control>-->
    <div class="has-padding-medium has-margin-top-medium">
      <p v-if="infos.record">
        <strong>Observation:</strong>
        {{infos.record.name}}
      </p>
      <p v-if="infos.outcome">
        <strong>Outcome:</strong>
        {{getOutcome(infos.outcome).label}}
      </p>
    </div>
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
      type: Object
    }
  },
  methods: {
    getOutcome(colour) {
      return Outcomes.find(outcome => outcome.colour === colour);
    }
  }
};
</script>
