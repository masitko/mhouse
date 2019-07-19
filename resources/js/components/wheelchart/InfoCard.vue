<template>
  <card
    fixed
    :title="__('Info:')"
    icon="eye"
    :controls="2"
    class="has-padding-medium wheel-info-card"
    :style="style"
  >
    <!-- <card-control slot="control-2">
    </card-control>-->
    <div
      class="has-padding-medium has-margin-top-medium has-background-light"
      style="border-radius: 0.5em; opacity:0.8;"
    >
      <p v-if="infos.record">
        <strong>Area:</strong>
        {{infos.record.areaName}}
      </p>
      <p v-if="infos.record">
        <strong>Observation:</strong>
        {{infos.record.name}}
      </p>
      <p v-if="infos.outcome">
        <strong>Score:</strong>
        {{getOutcome(infos.outcome).label}}
      </p>
    </div>
  </card>
  <!-- </div> -->
</template>

<script>
import Card from "../enso/bulma/Card.vue";
import CardControl from "../enso/bulma/CardControl.vue";
import Outcomes from "./outcomes.js";
import { faEye } from "@fortawesome/free-solid-svg-icons";

export default {
  name: "InfoCard",

  components: {
    Card,
    CardControl
  },

  computed: {
    style() {
      return [
        this.infos.record
          ? "background-color:" + this.infos.record.areaColour + " !important"
          : ""
      ].join(";");
    }
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
