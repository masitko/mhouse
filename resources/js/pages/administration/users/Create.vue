<template>
  <div class="columns is-centered">
    <div class="column is-three-quarters-desktop is-full-touch">
      <enso-form ref="form" class="box has-background-light raises-on-hover animated fadeIn">
        <!-- <template slot="group_id"
                    slot-scope="{ field, errors, i18n }">
                    <select-field :errors="errors"
                        :field="field"
                        :i18n="i18n"
                        @input="pivotParams.userGroups.id = $event"/>
        </template>-->
        <template slot="role_id" slot-scope="{ field, errors, i18n }">
          <select-field :errors="errors" :field="field" :i18n="i18n" :pivot-params="pivotParams"/>
        </template>
        <template slot="password" slot-scope="{ field, errors, i18n }">
          <input-field
            :errors="errors"
            autocomplete="new-password"
            :field="field"
            :i18n="i18n"
            @input="password = $event.target.value"
            v-if="!field.meta.hidden"
          />
          <password-strength class="has-margin-top-small" :password="field.value"/>
        </template>
        <template slot="password_confirmation" slot-scope="{ field, errors, i18n }">
          <input-field
            :errors="errors"
            autocomplete="new-password"
            :field="field"
            :i18n="i18n"
            @input="passwordConfirmation = $event.target.value"
            @keydown="$emit('update');"
            v-if="!field.meta.hidden"
          />
        </template>
        <template slot="post_code" slot-scope="{ field, errors, i18n }">
          <input-field
            :errors="errors"
            autocomplete="new-password"
            :field="field"
            :i18n="i18n"
            v-if="!field.meta.hidden"
          />
          <!-- @change="idaciUpdate($event)" -->
          <a :class="['button', {'is-loading': idaciLoading}]" @click="idaciUpdate()">
            <span>Fetch</span>
            <span class="icon is-small">
              <fa icon="sync"/>
            </span>
          </a>
        </template>
      </enso-form>
    </div>
  </div>
</template>

<script>
import EnsoForm from "../../../components/enso/vueforms/EnsoForm.vue";
import InputField from "../../../components/enso/vueforms/fields/InputField.vue";
import SelectField from "../../../components/enso/vueforms/fields/SelectField.vue";
import PasswordStrength from "../../auth/password/PasswordStrength.vue";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faSync } from "@fortawesome/free-solid-svg-icons";
import { Portuguese } from "flatpickr/dist/l10n/pt";

library.add(faSync);

export default {
  components: { EnsoForm, InputField, SelectField, PasswordStrength },

  created() {
    console.log(this);
  },

  data: () => ({
    pivotParams: {
      roles: { name: "student" },
      userGroups: { id: null }
    },
    idaciLoading: false,
    password: null,
    passwordConfirmation: null
  }),

  methods: {
    idaciUpdate() {
      let postCode = this.$refs.form.field("post_code").value;
      if (postCode && postCode.length > 3) {
        this.retrieveIdaci(postCode);
      } else {
        this.$toastr.error('Please enter a valid post code.');
      }
    },

    retrieveIdaci(postCode) {
      this.idaciLoading = true;
      axios
        .get(
          route("idaci.getForPostCode", {
            postCode: postCode
          })
        )
        .then(response => {
          this.idaciLoading = false;
          if( response.data.response["Postcode Status"] === 'Live' ) {
            this.$refs.form.field("idaci").value =
            response.data.response["IDACI Score"];
            this.$toastr.success('IDACI score fetched.');
          } else {
            this.$toastr.error('Please enter a valid post code.');
          }
        })
        .catch(error => {
          this.idaciLoading = false;
          if (axios.isCancel(error)) {
            this.axiosRequest = null;
            return;
          }
          this.handleError(error);
        });
    }
  }
};
</script>
