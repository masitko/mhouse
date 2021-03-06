<template>
  <canvas class="chart-js"/>
</template>

<script>
import Chart from "chart.js";
import "./chart-center.js";
import "./chart-title.js";
import "./chart-legend.js";
import "./core.tooltip.js";
import "chartjs-plugin-datalabels";
import Outcomes from "./outcomes.js";
import { Portuguese } from "flatpickr/dist/l10n/pt";
import { mapState, mapGetters, mapActions } from "vuex";

Chart.Tooltip = require("./core.tooltip");

Chart.scaleService.updateScaleDefaults("linear", { ticks: { min: 0 } });

let self;

export default {
  name: "Chart",

  props: {
    data: {
      type: Object,
      required: true
    },
    centerTitle: {
      type: String
    },
    title: {
      type: String
    },
    options: {
      type: Object,
      default: () => ({})
    },
    showLegend: {
      type: Boolean,
      default: true
    },
    disabled: {
      type: Boolean,
      default: true
    }
  },

  data: () => ({
    chart: null
  }),

  watch: {
    data() {
      // console.log("CHART CHANGE!");
      this.chart.options.elements.center.text = this.centerTitle;
      this.chart.options.elements.title.text = this.title;
      this.update();
    },
    showLegend() {
      // console.log("LEGEND CHANGE!");
      this.chart.options.legend.display = this.showLegend;
      this.chart.options.aspectRatio = this.showLegend ? 2 : 1.8;
      this.update();
    },
  },

  mounted() {
    this.init();
    // console.log(this);
    // console.log(Chart);
  },

  beforeDestroy() {
    this.chart.destroy();
  },

  computed: {
    // ...mapState('layout', ['themes']),
    ...mapGetters("preferences", ["theme"]),
    fontColour() {
      return this.theme === "dark" ? "white" : "black";
    }
  },

  methods: {
    init() {
      self = this;
      this.chart = new Chart(this.$el, {
        type: "pie",
        data: this.data,
        options: {
          // title: {
          //   display: true,
          //   fontColor: this.fontColour,
          //   fontStyle: 'bold',
          //   fontSize: 16,
          //   align: 'start',
          //   text: this.title,
          // },
          cutoutPercentage: 20,
          rotation: -0.45 * Math.PI,
          aspectRatio: this.showLegend ? 1.8 : 1.6,
          // maintainAspectRatio: false,
          elements: {
            title: {
              text: this.title,
              color: this.fontColour, // Default is #000000
              sidePadding: 20 // Defualt is 20 (as a percentage)
            },
            center: {
              text: this.centerTitle,
              color: this.fontColour, // Default is #000000
              sidePadding: 20 // Defualt is 20 (as a percentage)
            }
          },
          legend: {
            display: this.showLegend,
            position: "right",
            labels: {
              fontSize: 15,
              fontColor: this.fontColour
            }
          },
          animation: {
            duration: 700
          },
          layout: {
            padding: {
              top: 30,
              bottom: 10
            }
          },
          legendCallback: function(chart) {
            console.log("LEGEND CALLBACK !!!");
            return "<p>CUSTOM LEGEND</p>";
          },

          tooltips: false,
          // tooltips: {
          //   borderWidth: 1,
          //   borderColor: "white",
          //   bodyFontSize: 15,
          //   bofyFontStyle: "bold",
          //   bodySpacing: 5,
          //   // xAlign: "center",
          //   // titleAlign: 'center',
          //   // bodyAlign: "center",
          //   // footerAlign: 'center',
          //   displayColors: false,
          //   callbacks: {
          //     label(item, data) {
          //       // console.log(item, data);
          //       if (item) {
          //         if (
          //           typeof data.datasets[item.datasetIndex].records[
          //             item.index
          //           ] !== "undefined"
          //         )
          //           return data.datasets[item.datasetIndex].records[item.index][
          //             item.datasetIndex ? "name" : "description"
          //           ];
          //         else return "not set";
          //       }
          //     },
          //     afterLabel(item, data) {
          //       if (
          //         item &&
          //         item.datasetIndex &&
          //         typeof data.datasets[item.datasetIndex].records[
          //           item.index
          //         ] !== "undefined"
          //       ) {
          //         const record =
          //           data.datasets[item.datasetIndex].records[item.index];
          //         const outcomes = data.datasets[item.datasetIndex].outcomes;
          //         if (typeof Outcomes[outcomes[record.id]] !== "undefined")
          //           return (
          //             "Current score: " + Outcomes[outcomes[record.id]].label
          //           );
          //       }
          //     }
          //   }
          // },
          onHover: function(event, elements) {
            // console.log('HOVER', elements);
            if (
              elements.length &&
              elements[0].$datalabels.$context.datasetIndex
            ) {
              const context = elements[0].$datalabels.$context;
              const record = context.dataset.records[context.dataIndex];
              const outcomes = context.dataset.outcomes;
              self.$emit("change", {
                record: record,
                outcome: Outcomes[outcomes[record.id]].colour,
                type: "hover"
              });
            } else {
              self.$emit("change", {});
            }
          },
          onClick: function(event, elements) {
            event.stopPropagation();
            if (self.disabled) return false;
            if (
              elements.length &&
              elements[0].$datalabels.$context.datasetIndex
            ) {
              const context = elements[0].$datalabels.$context;
              const record = context.dataset.records[context.dataIndex];
              const outcomes = context.dataset.outcomes;
              outcomes[record.id]++;
              outcomes[record.id] %= Outcomes.length;
              if (Outcomes[outcomes[record.id]].colour !== "clear")
                context.dataset.backgroundColor[context.dataIndex] =
                  Outcomes[outcomes[record.id]].colour;
              else
                context.dataset.backgroundColor[context.dataIndex] =
                  record.areaColour;
              this.update();
              self.$emit("change", {
                record: record,
                outcome: Outcomes[outcomes[record.id]].colour,
                type: "click"
              });
            }
            return false;
          },

          plugins: {
            datalabels: {
              anchor: "center",
              align: "middle",
              borderRadius: 5,
              opacity: 0.75,
              color: "black",
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
                    return (
                      context.dataset.records[context.dataIndex].questionIndex +
                      1
                    );
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
        // dataset.datalabels.backgroundColor = this.data.datasets[
        //   index
        // ].datalabels.backgroundColor;
        // dataset.datalabels.backgroundColor = "white";
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
