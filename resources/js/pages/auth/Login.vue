<template>
    <auth-form is-login
        action="Login"
        route="login"
        @success="init"/>
</template>

<script>

import { mapMutations, mapState } from 'vuex';
import AuthForm from './AuthForm.vue';

export default {
    name: 'Login',

    components: { AuthForm },

    computed: {
        // ...mapState(['meta']),
    },

    methods: {
        ...mapMutations('auth', ['login', 'auth1f']),
        ...mapMutations('layout', ['showHome']),
        // ...mapMutations(['setShowQuote', 'setCsrfToken']),
        ...mapMutations(['setCsrfToken']),
        init(data) {
            console.log( 'LOGGING IN - 1st factor ');
            // this.setShowQuote(this.meta.showQuote);
            this.setCsrfToken(data.csrfToken);
            setTimeout(() => {
                this.auth1f();
                // this.login();
                // this.showHome();
            }, 500);
        },
    },
};

</script>
