<template>
  <auth-form is-login action="Login" route="login" @success="init"/>
</template>

<script>
import { mapMutations, mapState } from "vuex";
import AuthForm from "./AuthForm.vue";

export default {
  name: "Login",

  components: { AuthForm },

  computed: {
    // ...mapState(['meta']),
  },

  methods: {
    ...mapMutations("auth", ["login", "auth1f"]),
    ...mapMutations("layout", ["showHome"]),
    // ...mapMutations(['setShowQuote', 'setCsrfToken']),
    ...mapMutations(["setCsrfToken"]),
    init(data) {
      // this.setShowQuote(this.meta.showQuote);
      this.setCsrfToken(data.csrfToken);
      setTimeout(() => {
        if (data.ipConfirmed === true) {
          this.login();
          this.showHome();
          // this.$router.push({path:'/'});
        } else {
          this.auth1f();
          this.$router.push({ name: "auth.code" });
        }
      }, 500);
    }
  }
};
</script>
