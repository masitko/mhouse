<template>
    <vue-table class="box has-background-light is-paddingless raises-on-hover is-rounded"
        :path="path"
        id="wheels"/>
</template>

<script>

import VueTable from '../../../components/enso/vuedatatable/VueTable.vue';

export default {
    components: { VueTable },

    data: () => ({
        path: route('wheels.wheels.initTable'),
    }),
};

</script>

<style lang="scss">
</style>
