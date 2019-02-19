<template>
  <div class="columns is-centered">
    <div class="column is-three-quarters-desktop is-full-touch">
      <!-- <p>{{observations}}</p> -->
      <enso-form
        class="box has-background-light raises-on-hover animated fadeIn"
        ref="form"
        @loaded="formLoaded(this)"
      >
        <template slot="areas" slot-scope="{ field, errors, i18n }">
          <select-field
            :errors="errors"
            :field="field"
            :i18n="i18n"
            @input="inputChange"
            @fetch="areasFetched"
          />
        </template>

        <template slot="observations">
          <div class="animated fadeIn" v-if="fetched">
            <checkbox-manager
              class="is-rounded has-margin-top-large"
              :title="`Please select required observations`"
              :role-permissions="$refs.form.formData().observations"
              :data="structure"
              @change="change"
            />
          </div>
        </template>

        <template slot="wheelchart">
          <div class="animated fadeIn is-half" v-if="wheelData">
            <chart-card
              class="is-rounded has-background-light raises-on-hover has-margin-bottom-large"
              :title="title"
              :wheel-data="wheelData"
            />
          </div>
        </template>
      </enso-form>
    </div>
  </div>
</template>

<script>
import EnsoForm from "../../../components/enso/vueforms/EnsoForm.vue";
import SelectField from "../../../components/enso/vueforms/fields/SelectField.vue";
import CheckboxManager from "../../../components/observationsmanager/CheckboxManager.vue";
import ChartCard from "../../../components/wheelchart/ChartCard.vue";

export default {
  components: { EnsoForm, SelectField, CheckboxManager, ChartCard },

  data: () => ({
    data: null,
    loaded: false,
    fetched: false,
    areas: false,
    areaOptions: false,
    observations: false,
    structure: { _items: [] },
    title: "Wheel Preview",
    wheelData: false,
    // wheelData: {
    //   data: false,
    // }
  }),

  created() {
    this.fetch();
  },

  methods: {
    change() {
      console.log("EDIT CHANGE!!!");
      // console.log(this.areas);
      // console.log(this.observations);
      // console.log(this.structure);
      this.prepareWheel();
    },

    prepareWheel(){
      const areas = [];
      const layers = this.$refs.form.formData().layers;
      let column = 0;
      this.areas.forEach( areaId => {
        const area = _.find(this.areaOptions, { id: areaId });
        const observations = this.data.filter(obs => 
          obs.area_id === areaId && (this.observations.indexOf(obs.id) > -1 ) )
        if( observations.length) {
          areas.push(area);
          area.columnIndex = column;
          area.columns = Math.ceil(observations.length/layers);
          column += area.columns;
          area.selection = observations;
        }
      });
      this.wheelData = {
      // this.wheelData.data = {
        layers: layers,
        areas:areas
      };
    },

    formLoaded(self) {
      // console.log("FORM LOADED!!!!");
      this.loaded = true;
    },
    areasFetched(options) {
      console.log("AREAS FETCHED!!!!");
      this.areas = this.$refs.form.formData().areas;
      this.observations = this.$refs.form.formData().observations;
      this.areaOptions = options;
      this.inputChange(this.areas);
      this.fetched = true;
    },
    inputChange(areas) {
      console.log("INPUT CHANGED!!!!");
      this.structure = { _items: [] };
      areas.forEach(areaId => {
        this.structure[_.find(this.areaOptions, { id: areaId }).name] = {
          _items: this.data.filter(obs => obs.area_id === areaId)
        };
      });
    },
    fetch() {
      axios
        .get(route("wheels.observations.options"))
        .then(({ data }) => (this.data = data))
        .catch(error => this.handleError(error));
    }
  }
};
</script>

<style lang="scss">
</style>
