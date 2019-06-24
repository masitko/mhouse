<template>
  <a :class="['button', {'is-loading': idaciLoading}]" @click="idaciUpdate()">
    <span>Fetch</span>
    <span class="icon is-small">
      <fa icon="sync"/>
    </span>
    <span></span>
  </a>
</template>


<script>
export default {
  name: "IdaciFetcher",

  props: {
    source: { // field for post code source
      type: Object
    },
    target: { // field for idaci score  
      type: Object
    }
  },
  data: () => ({
    idaciLoading: false
  }),

  created() {
    console.log(this);
  },

  methods: {
    idaciUpdate() {
      console.log(this.source);
      let postCode = this.source.value;
      if (postCode && postCode.length > 3) {
        this.retrieveIdaci(postCode);
      } else {
        this.$toastr.error("Please enter a valid post code.");
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
          if (response.data.response["Postcode Status"] === "Live") {
            this.target.value =
              response.data.response["IDACI Score"];
            this.$toastr.success("IDACI score fetched.");
          } else {
            this.$toastr.error("Please enter a valid post code.");
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