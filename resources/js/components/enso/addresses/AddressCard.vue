<template>
    <div class="box has-background-light raises-on-hover">
        <div class="media">
            <div class="media-content">
                <span class="icon is-pulled-right has-text-success"
                    v-tooltip="__('default')"
                    v-if="address.isDefault">
                    <fa icon="anchor"/>
                </span>
                <slot name="address" :address="address">
                    <strong v-if="address.number">
                        {{ address.number }}
                    </strong>
                    <strong>
                        {{ address.address1 }}
                    </strong>
                    <strong v-if="address.address2">
                        <br>
                        {{ address.address2 }}
                    </strong>
                    <br>
                    <strong>
                        {{ address.town }}
                    </strong>
                    <strong v-if="address.county">
                        <br>
                        {{ address.county }}
                    </strong>
                    <br>
                    <strong>
                        {{ address.country }}
                    </strong>
                    <br>
                    <span class="icon"
                        v-if="address.notes">
                        <fa icon="sticky-note"/>
                    </span>
                     {{ address.notes }}
                </slot>
            </div>
        </div>
        <div class="has-text-centered has-margin-top-medium">
            <div class="details">
                <button class="button is-naked"
                    @click="$emit('edit')">
                    <span class="icon">
                        <fa icon="pencil-alt"/>
                    </span>
                </button>
                <button class="button is-naked"
                    @click="$emit('set-default')">
                    <span class="icon">
                        <fa icon="anchor"/>
                    </span>
                </button>
                <popover placement="top"
                    @confirm="$emit('delete')">
                    <button class="button is-naked">
                        <span class="icon">
                            <fa icon="trash-alt"/>
                        </span>
                    </button>
                </popover>
            </div>
        </div>
    </div>
</template>

<script>

import { VTooltip } from 'v-tooltip';
import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faPencilAlt, faAnchor, faGlobe, faStickyNote, faTrashAlt,
} from '@fortawesome/free-solid-svg-icons';
import Popover from '../bulma/Popover.vue';

library.add(faPencilAlt, faAnchor, faGlobe, faStickyNote, faTrashAlt);

export default {
    name: 'AddressCard',

    components: { Popover },

    directives: { tooltip: VTooltip },

    props: {
        address: {
            type: Object,
            required: true,
        },
    },
};

</script>

<style lang="scss" scoped>

    .media-content {
        min-height: 148px;
    }

    .details {
        display: flex;
        justify-content: center;
    }

</style>
