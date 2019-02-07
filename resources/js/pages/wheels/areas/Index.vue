<template>
    <vue-table class="box has-background-light is-paddingless raises-on-hover is-rounded"
        :path="path"
        id="areas"/>
</template>

<script>

import VueTable from '../../../components/enso/vuedatatable/VueTable.vue';

export default {
    components: { VueTable },

    data: () => ({
        path: route('wheels.areas.initTable'),
    }),
};

</script>

<style lang="scss">
</style>
