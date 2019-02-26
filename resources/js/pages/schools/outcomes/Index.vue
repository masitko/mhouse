<template>
    <div class="wrapper">
        <div class="has-text-centered"
            v-if="!ready && loading">
            <h4 class="title is-4 has-text-centered">
                {{ __('Loading') }}
                <span class="icon is-small has-margin-left-medium">
                    <fa icon="spinner"
                        size="xs"
                        spin/>
                </span>
            </h4>
        </div>
        <div class="columns is-reverse-mobile">
            <div class="column is-three-quarters">
              {{filters}}
                <!-- <timeline class="raises-on-hover"
                    :feed="feed"
                    :loading="loading"
                    @load-more="fetch()"/> -->
            </div>
            <div class="column is-one-quarter">
                <button class="button is-fullwidth"
                    :class="{ 'is-loading': loading }"
                    @click="reload()">
                    <span>
                        {{ __('Reload') }}
                    </span>
                    <span class="icon">
                        <fa icon="sync-alt"/>
                    </span>
                </button>
                <!-- <date-filter class="box raises-on-hover has-margin-top-large"
                    :locale="locale"
                    @update="filters.interval = $event"/> -->
                <div class="box has-padding-medium raises-on-hover has-background-light">
                    <p class="has-text-centered">
                        <strong>{{ __('What') }}</strong>
                    </p>
                    <vue-select-filter 
                        source="wheels.wheels.options"
                        :placeholder="__('Wheel Type')"
                        v-model="filters.wheelId"/>
                    <vue-select-filter 
                        source="administration.users.options"
                        :placeholder="__('Select Student')"
                        v-model="filters.userId"/>
                    <vue-select-filter 
                        source="schools.terms.options"
                        label="name"
                        :placeholder="__('Select Term')"
                        v-model="filters.termId"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faSpinner } from '@fortawesome/free-solid-svg-icons';
import VueSelectFilter from '../../../components/enso/select/VueSelectFilter.vue';

library.add(faSpinner);

export default {
    components: {
        Timeline,
        DateFilter,
        VueSelectFilter,
    },

    data: () => ({
        ready: false,
        loading: false,
        axiosRequest: null,
        feed: [],
        offset: 0,
        filters: {
            userId: null,
            termId: null,
            wheelId: null,
        },
    }),

    computed: {
        ...mapGetters('preferences', { locale: 'lang' }),
    },

    watch: {
        filters: {
            handler() {
                this.reload();
            },
            deep: true,
        },
    },

    methods: {
        fetch() {
            if( !this.filters.userId || !this.filters.termId || !this.filters.wheelId )
              return;
            this.loading = true;

            if (this.axiosRequest) {
                this.axiosRequest.cancel();
            }

            this.axiosRequest = axios.CancelToken.source();

            axios.get(route('core.activityLogs.index'), {
                params: { offset: this.offset, filters: this.filters },
                cancelToken: this.axiosRequest.token,
            }).then(({ data }) => {
                const length = this.length(data);

                if (this.offset === 0) {
                    this.feed = data;
                } else {
                    this.merge(data);
                }

                this.offset += length;
                this.loading = false;
                this.ready = true;
            }).catch((error) => {
                if (axios.isCancel(error)) {
                    this.axiosRequest = null;
                    return;
                }

                this.handleError(error);
            });
        },
        reload() {
            this.offset = 0;
            this.fetch();
        },
        length(feed) {
            return feed.reduce((total, { list }) => (total += list.length), 0);
        },
        merge(feed) {
            if (!feed.length) {
                return;
            }

            if (this.feed[this.feed.length - 1].date === feed[0].date) {
                this.feed[this.feed.length - 1].list.push(...feed.shift().list);
            }

            this.feed.push(...feed);
        },
    },
};
</script>

<style lang="scss">
</style>
