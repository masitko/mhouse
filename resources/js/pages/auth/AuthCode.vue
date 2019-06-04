<template>
  <auth-form is-confirm action="Confirm code" route="auth.code" @success="init"/>
</template>

<script>
import { mapMutations, mapState } from "vuex";
import AuthForm from "./AuthForm.vue";

export default {
  name: "AuthCode",

  components: { AuthForm },

  computed: {
    // ...mapState(['meta']),
  },

  methods: {
    ...mapMutations("auth", ["login"]),
    ...mapMutations("layout", ["showHome"]),
    // ...mapMutations(['setShowQuote', 'setCsrfToken']),
    ...mapMutations(["setCsrfToken"]),
    init(data) {
      console.log(data);
      // this.setShowQuote(this.meta.showQuote);
      this.setCsrfToken(data.csrfToken);
      setTimeout(() => {
        if (data.ipConfirmed === true) {
          console.log("LOGGING IN...");
          // this.login();
        } else {
          console.log("WRONG CODE !!!!");
          // this.auth1f();
          // this.$router.push({ name: "auth.code" });
        }
        // this.showHome();
      }, 500);
    }
  }
};
</script>
