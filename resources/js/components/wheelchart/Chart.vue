<template>
  <canvas class="chart-js"/>
</template>

<script>
import Chart from "chart.js";
import "chartjs-plugin-datalabels";
import { Portuguese } from "flatpickr/dist/l10n/pt";

// Chart.defaults.global.plugins.datalabels.formatter = value => `${format(value)}m`;

Chart.scaleService.updateScaleDefaults("linear", { ticks: { min: 0 } });

const types = [
  "line",
  "bar",
  "radar",
  "polarArea",
  "pie",
  "doughnut",
  "bubble"
];

export default {
  name: "Chart",

  props: {
    data: {
      type: Object,
      required: true
    },
    options: {
      type: Object,
      default: () => ({})
    }
  },

  data: () => ({
    chart: null
  }),

  watch: {
    data() {
      console.log("CHART CHANGE!");
      this.update();
    }
  },

  mounted() {
    this.init();
  },

  beforeDestroy() {
    this.chart.destroy();
  },

  methods: {
    init() {
      this.chart = new Chart(this.$el, {
        type: 'pie',
        data: this.data,
        options: {
          cutoutPercentage: 10,
          aspectRatio: 4 / 2,
          legend: {
            position: "right"
          },

          // tooltips: false,
          tooltips: {
            callbacks: {
              label(item, data) {
                // console.log(item, data);
                if (item)
                  if (
                    item.datasetIndex &&
                    typeof data.datasets[item.datasetIndex].records[
                      item.index
                    ] !== "undefined"
                  )
                    return data.datasets[item.datasetIndex].records[item.index]
                      .name;
                  else return "not set";
              }
            }
          },
          onClick: function(event, elements) {
            // console.log(event);
            console.log("CLICK ", elements);
            if (elements.length) {
              const context = elements[0].$datalabels.$context;
              context.dataset.backgroundColor[context.dataIndex] = "#000";
              this.update();
            }
            // return true;
            // elements[0]._model.backgroundColor="#00F000";
          },

          plugins: {
            datalabels: {
              anchor: "center",
              align: "middle",
              borderRadius: 3,
              // padding: 2,
              color: "white",
              font: {
                style: "bold"
              },
              listeners: {
                click(context) {
                  console.log("DATALABEL ", context);
                }
              },
              formatter(value, context) {
                // console.log(context);
                if (context.datasetIndex === 0)
                  return context.dataset.labels[context.dataIndex];
                else {
                  if (
                    typeof context.dataset.records[context.dataIndex] !==
                    "undefined"
                  ) {
                    return context.dataset.records[context.dataIndex]
                      .questionIndex;
                  } else {
                    return "";
                  }
                }
              },
              display({ chart, datasetIndex }) {
                const meta = chart.getDatasetMeta(datasetIndex);
                return !meta.hidden;
              }
            }
          },
          ...this.options
        }
      });
    },
    update() {
      if (!this.chart) {
        this.init();
        return;
      }

      this.updateDatasets();
      this.chart.data.labels = this.data.labels;
      this.chart.update();
    },
    updateDatasets() {
      this.$set(this.chart.data, "datasets", this.data.datasets);

      this.chart.data.datasets.forEach((dataset, index) => {
        dataset.data = this.data.datasets[index].data;
        dataset.backgroundColor = this.data.datasets[index].backgroundColor;
        dataset.datalabels.backgroundColor = this.data.datasets[
          index
        ].datalabels.backgroundColor;
      });
    },
    svg() {
      return this.$el.toDataURL("image/jpg");
    }
  }
};
</script>

<style scoped>
.chart-js {
  max-width: 100%;
}
</style>
