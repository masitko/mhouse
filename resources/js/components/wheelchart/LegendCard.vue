<template>
  <card :title="__('Legend:')" icon="list" :controls="2" class="has-padding-medium">
    <!-- <card-control slot="control-2">
    </card-control>-->
    <ul class="has-padding-medium has-margin-top-medium">
      <li v-for="outcome in outcomes" :key="outcome.value">
        <button class="button is-small" disabled :style="{'background-color':outcome.colour}"></button> 
        <strong>{{outcome.label}}</strong>
        <span> - {{outcome.response}}</span>
      </li>
      <!-- <p>
        <button class="button is-small" disabled style="background-color:orange"></button> 
        <span> this is some text</span>
      </p>
      <p>
        <button class="button is-small" disabled style="background-color:yellow"></button> 
        <span> this is some text</span>
      </p>
      <p>
        <button class="button is-small" disabled ></button> 
        <span> this is some text</span>
      </p> -->
    </ul>
  </card>
  <!-- </div> -->
</template>

<script>
import Card from "../enso/bulma/Card.vue";
import CardControl from "../enso/bulma/CardControl.vue";
import Outcomes from "./outcomes.js";
import { faList } from "@fortawesome/free-solid-svg-icons";

export default {
  name: "LegendCard",
  components: {
    Card,
    CardControl
  },

  data() {
    return {
      outcomes: Outcomes,
    }
  },
  props: {},

  methods: {}
};
</script>
