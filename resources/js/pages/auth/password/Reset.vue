<template>
    <auth-form is-reset
            action="Set a new password"
            route="password.reset"
            @success="success">
            <p slot="password-strength"
                slot-scope="{ password }"
                class="help">
                <password-strength :password="password"/>
            </p>
        </auth-form>
</template>

<script>
import { mapMutations, mapState } from "vuex";
import AuthForm from '../AuthForm.vue';
import PasswordStrength from './PasswordStrength.vue';

export default {
    name: 'Reset',

    components: { AuthForm, PasswordStrength },

    methods: {
      ...mapMutations("auth", ["login"]),

        success({ status }) {
            this.$toastr.success(status);
            setTimeout(() => {
              this.login();
              this.showHome();
              // this.$router.push({ name: 'login' })
            }, 350);
        },
    },
};

</script>
