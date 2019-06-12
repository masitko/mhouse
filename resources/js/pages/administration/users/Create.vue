<template>
<div class="columns is-centered">
        <div class="column is-three-quarters-desktop is-full-touch">
            <enso-form class="box has-background-light raises-on-hover animated fadeIn">
                <!-- <template slot="group_id"
                    slot-scope="{ field, errors, i18n }">
                    <select-field :errors="errors"
                        :field="field"
                        :i18n="i18n"
                        @input="pivotParams.userGroups.id = $event"/>
                </template> -->
                <template slot="role_id"
                    slot-scope="{ field, errors, i18n }">
                    <select-field :errors="errors"
                        :field="field"
                        :i18n="i18n"
                        :pivot-params="pivotParams"
                        />
                </template>
                <template slot="password"
                    slot-scope="{ field, errors, i18n }">
                    <input-field :errors="errors"
                        autocomplete="new-password"
                        :field="field"
                        :i18n="i18n"
                        @input="password = $event.target.value"
                        v-if="!field.meta.hidden"/>
                    <password-strength class="has-margin-top-small"
                        :password="field.value"/>
                </template>
                <template slot="password_confirmation"
                    slot-scope="{ field, errors, i18n }">
                    <input-field :errors="errors"
                        autocomplete="new-password"
                        :field="field"
                        :i18n="i18n"
                        @input="passwordConfirmation = $event.target.value"
                        @keydown="$emit('update');"
                        v-if="!field.meta.hidden"/>
                </template>
            </enso-form>
        </div>
    </div>
</template>

<script>

import EnsoForm from '../../../components/enso/vueforms/EnsoForm.vue';
import InputField from '../../../components/enso/vueforms/fields/InputField.vue';
import SelectField from '../../../components/enso/vueforms/fields/SelectField.vue';
import PasswordStrength from '../../auth/password/PasswordStrength.vue';

export default {
    components: { EnsoForm, InputField, SelectField, PasswordStrength },

    data: () => ({
        pivotParams: { 
          roles: { name: 'student'},
          userGroups: { id: null } 
          },
        password: null,
        passwordConfirmation: null,

    }),
};

</script>
