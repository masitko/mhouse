<template>
  <card
    refresh
    :title="title"
    icon="chart-pie"
    :overlay="loading"
    :controls="1"
    @refresh="update"
    v-if="config"
  >
    <card-control slot="control-1">
      <span class="icon is-small download" @click="download">
        <fa icon="download"/>
      </span>
    </card-control>
    <chart class="has-padding-medium" 
      :title="`Wheel Preview`"
      :data="config.data" 
      :options="config.options" 
      ref="chart"
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

library.add([faChartPie, faDownload]);

export default {
  name: "ChartCard",

  components: { Card, CardControl, Chart },

  props: {
    wheelData: {
      type: Object,
      default: null
    },
    title: {
      type: String,
      default: ""
    }
  },

  data() {
    return {
      loading: false,
      config: null
    };
  },

  watch: {
    wheelData: {
      handler() {
        // console.log("WHEEL DATA CHANGE!!!");
        this.update();
      }
      // deep: true
    }
  },

  mounted() {
    this.update();
  },

  methods: {
    update() {
      if (this.wheelData) {
        this.config = {
          data: this.processData(this.wheelData)
        };
      }
    },

    processData(wheel) {
      const data = {};
      // prepare main labels to be showed in the legend
      data.labels = wheel.areas.map(area => area.name);
      data.datasets = [];
      data.datasets.push(this.processLayer0(wheel.areas));
      for (let i = 0; i < wheel.layers; i++) {
        data.datasets.push(this.processLayer(wheel, i));
      }
      return data;
    },

    processLayer0(areas) {
      return {
        records: areas,
        data: areas.map(area => 10 * area.columns),
        labels: areas.map(area => area.name),
        backgroundColor: areas.map(area => area.colour),
        datalabels: {
          backgroundColor: areas.map(area => area.colour),
          borderWidth: 1,
          borderColor: "#FFFFFF",
          font: {
            size: 15,

          },
          anchor: "center",
          align: "end"
        }
      };
    },
    processLayer(wheel, layer) {
      const dataset = {
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
          // set index od observation record
          let index = wheel.layers - layer - 1 + i * wheel.layers;
          if (typeof area.selection[index] !== "undefined") {
            area.selection[index].questionIndex = index;
            area.selection[index].outcome = 3;
            area.selection[index].areaColour = area.colour;
          }
          dataset.records.push(area.selection[index]);
          dataset.data.push(10);
          dataset.labels.push(area.name);
          dataset.backgroundColor.push(area.colour);
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
