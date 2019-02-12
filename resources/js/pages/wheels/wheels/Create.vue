<template>
  <div class="columns is-centered">
    <div class="column is-three-quarters-desktop is-full-touch">
      <enso-form class="box has-background-light raises-on-hover animated fadeIn" ref="form">
        <template slot="areas" slot-scope="{ field, errors, i18n }">
          <select-field :errors="errors" :field="field" :i18n="i18n" @input="inputChange($event)"/>
        </template>

        <template slot="observations">
          <div class="animated fadeIn" v-if="data">
            <checkbox-manager
              class="is-rounded has-margin-top-large"
              :title="`Please select required observations`"
              :role-permissions="$refs.form.formData().observations"
              :data="pivotParams.structure"
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

export default {
  components: { EnsoForm, SelectField, CheckboxManager },

  data: () => ({
    data: null,
    pivotParams: {
      // areas: [],
      structure: { _items: [] }
    }
  }),

  created() {
    this.fetch();
  },

  methods: {
    inputChange(areas) {
      var options = this.$refs.form.field("areas").meta.options;
      this.pivotParams.structure = { _items: [] };
      areas.forEach(areaId => {
        this.pivotParams.structure[_.find(options, { id: areaId }).name] = {
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
