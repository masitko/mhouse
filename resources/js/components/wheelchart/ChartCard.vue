<template>
  <card refresh :title="title" icon="chart-pie" :overlay="loading" :controls="1" @refresh="update">
    <card-control slot="control-1">
      <span class="icon is-small download" @click="download">
        <fa icon="download"/>
      </span>
    </card-control>
    <chart
      class="has-padding-medium"
      :title="title"
      :show-legend="showLegend"
      :disabled="disabled"
      :data="config.data"
      ref="chart"
      v-if="config"
      @change="$emit('change', $event)"
    />
  </card>
</template>

<script>
import { saveAs } from "file-saver";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faChartPie, faDownload } from "@fortawesome/free-solid-svg-icons";
import Card from "../enso/bulma/Card.vue";
import CardControl from "../enso/bulma/CardControl.vue";
import Chart from "./Chart.vue";
import Outcomes from "./outcomes.js";

library.add([faChartPie, faDownload]);

export default {
  name: "ChartCard",

  components: { Card, CardControl, Chart },

  props: {
    wheelData: {
      type: Object,
      default: null
    },
    outcomes: {
      type: Object,
      default: () => ({})
    },
    title: {
      type: String,
      default: ""
    },
    showLegend: {
      type: Boolean,
      default: true
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      loading: false,
      config: null,
      wheelChanging: false,
    };
  },

  watch: {
    wheelData: {
      handler() {
        // console.log("WHEEL DATA CHANGE!!!");
        this.update();
      }
      // deep: true
    },
    outcomes: {
      handler() {
        // console.log("OUTCOMES DATA CHANGE!!!");
        this.update();
      }
    }
  },

  mounted() {
    this.update();
  },

  methods: {
    update() {
      if (this.wheelData && this.wheelData.areas) {
        this.wheelData.outcomes = this.outcomes;
        this.config = {
          data: this.processData(this.prepareData(this.wheelData))
        };
      } else {
        this.config = null;
      }
    },

    prepareData(wheel) {
      let column = 0;
      wheel.areas = wheel.areas.sort((a, b) => a.order > b.order);
      wheel.areas.forEach(area => {
        area.selection = wheel.observations
          .filter(obs => obs.area_id === area.id)
          .sort((a, b) => a.order > b.order);
        area.columnIndex = column;
        area.columns = Math.ceil(area.selection.length / wheel.layers);
        column += area.columns;
      });
      // console.log(wheel);
      return wheel;
    },

    processData(wheel) {
      const data = {};
      // prepare main labels to be showed in the legend
      data.labels = wheel.areas.map(area => area.name);
      data.datasets = [];
      data.datasets.push(this.processLayer0(wheel));
      for (let i = 0; i < wheel.layers; i++) {
        data.datasets.push(this.processLayer(wheel, i));
      }
      return data;
    },

    processLayer0(wheel) {
      return {
        outcomes: wheel.outcomes,
        records: wheel.areas,
        data: wheel.areas.map(area => 10 * area.columns),
        labels: wheel.areas.map(area => area.name),
        backgroundColor: wheel.areas.map(area => area.colour),
        datalabels: {
          backgroundColor: wheel.areas.map(area => area.colour),
          borderWidth: 1,
          borderColor: "#FFFFFF",
          font: {
            size: 15
          },
          anchor: "center",
          align: "end"
        }
      };
    },
    processLayer(wheel, layer) {
      const dataset = {
        outcomes: wheel.outcomes,
        records: [],
        data: [],
        labels: [],
        backgroundColor: [],
        datalabels: {
          backgroundColor: []
        }
      };
      wheel.areas.forEach(area => {
        for (let i = 0; i < area.columns; i++) {
          // set index of observation record
          let index = wheel.layers - layer - 1 + i * wheel.layers;
          let backgroundColor = area.colour;
          if (typeof area.selection[index] !== "undefined") {
            let record = area.selection[index];
            record.questionIndex = index;
            record.areaColour = area.colour;
            if (typeof wheel.outcomes[record.id] === "undefined") {
              // console.log('setting default value');
              wheel.outcomes[record.id] = 3; // default value
            }
            if (Outcomes[wheel.outcomes[record.id]].colour !== "clear") {
              backgroundColor = Outcomes[wheel.outcomes[record.id]].colour;
            }
          }
          dataset.records.push(area.selection[index]);
          dataset.data.push(10);
          dataset.labels.push(area.name);
          dataset.backgroundColor.push(backgroundColor);
          dataset.datalabels.backgroundColor.push(area.colour);
        }
      });
      return dataset;
    },

    download() {
      this.$refs.chart.$el.toBlob(blob =>
        saveAs(blob, `${this.config.title}.png`)
      );
    }
  }
};
</script>
