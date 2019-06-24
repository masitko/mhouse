<template>
  <div class="columns is-centered">
    <div class="column is-three-quarters-desktop is-full-touch">
      <enso-form
        class="box has-background-light raises-on-hover animated fadeIn"
        ref="form"
        @loaded="
                    ready = true;
                "
      >
        <template slot="role_id" slot-scope="{ field, errors, i18n }">
          <select-field :errors="errors" :field="field" :i18n="i18n" :pivot-params="pivotParams"/>
        </template>
        <template slot="password" slot-scope="{ field, errors, i18n }">
          <input-field
            :errors="errors"
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
        </template>
        <template slot="idaci_fetcher" slot-scope="{}">
          <idaci-fetcher
            :source="$refs.form.field('post_code')"
            :target="$refs.form.field('idaci')"
          />
        </template>
      </enso-form>
      <accessories v-if="ready">
        <template slot-scope="{ count }">
          <tab keep-alive id="Addresses">
            <addresses
              controls
              type="App\User"
              :id="$refs.form.routeParam('user')"
              @update="$set(count, 'addresses', $refs.addresses.count)"
              ref="addresses"
            />
          </tab>
        </template>
      </accessories>
    </div>
  </div>
</template>

<script>
import IdaciFetcher from "./IdaciFetcher.vue";
import EnsoForm from "../../../components/enso/vueforms/EnsoForm.vue";
import InputField from "../../../components/enso/vueforms/fields/InputField.vue";
import SelectField from "../../../components/enso/vueforms/fields/SelectField.vue";
import PasswordStrength from "../../auth/password/PasswordStrength.vue";

import Accessories from "../../../components/enso/bulma/Accessories.vue";
import Tab from "../../../components/enso/bulma/Tab.vue";
import Addresses from "../../../components/enso/addresses/Addresses.vue";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faSync } from "@fortawesome/free-solid-svg-icons";
library.add(faSync);

export default {
  components: {
    IdaciFetcher,
    EnsoForm,
    InputField,
    SelectField,
    PasswordStrength,
    Accessories,
    Tab,
    Addresses
  },

  created() {
    console.log(this.$refs.form);
  },

  data: () => ({
    ready: false,
    pivotParams: { userGroups: { id: null } },
    password: null,
    passwordConfirmation: null
  })
};
</script>
