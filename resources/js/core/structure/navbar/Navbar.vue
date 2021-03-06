<template>
  <nav class="navbar app-navbar has-background-light is-fixed-top">
    <div class="navbar-brand">
      <a class="navbar-item" href="#">
        <figure class="image is-32x32">
          <img
            class="school-logo"
            :src="$store.getters.logoLink"
            onerror="this.style.display='none'"
          />
        </figure>
        <h4
          v-if="menu.isExpanded && !isMobile"
          class="title is-4 animated has-margin-left-small"
        >{{ $store.getters.mainTitle }}</h4>
      </a>
      <a class="navbar-item" @click="toggleMenu(isTouch)">
        <span class="icon is-small">
          <fa icon="bars" :class="{ 'rotate': !menu.isExpanded || !menu.isVisible }" />
        </span>
      </a>
      <div v-if="meta.env === 'local'" class="navbar-item">
        <!-- <span class="tag is-warning">
                    <span class="icon is-small">
                        <fa icon="code"/>
                    </span>
        </span>-->
      </div>
      <div v-if="impersonating" class="navbar-item">
        <button
          v-tooltip="__('Impersonating')"
          class="button is-small is-warning"
          @click="$root.$emit('stop-impersonating')"
        >
          <span class="icon is-small">
            <fa icon="user" />
          </span>
          <span class="icon is-small">
            <fa icon="times" />
          </span>
        </button>
      </div>
      <div v-if="isTouch" class="is-pulled-right is-flex">
        <search v-if="!isMobile" />
        <!-- <i-o/> -->
        <notifications />
        <profile-control />
        <settings-control />
      </div>
    </div>
    <div class="navbar-menu">
      <div v-if="!isTouch" class="navbar-end">
        <!-- <search/> -->
        <!-- <i-o/> -->
        <notifications />
        <profile-control />
        <settings-control />
      </div>
    </div>
  </nav>
</template>

<script>
import { mapState, mapMutations } from "vuex";
import { VTooltip } from "v-tooltip";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faBars,
  faCode,
  faUser,
  faTimes
} from "@fortawesome/free-solid-svg-icons";
import IO from "./IO.vue";
import Notifications from "./Notifications.vue";
import SettingsControl from "./SettingsControl.vue";
import ProfileControl from "./ProfileControl.vue";
import Search from "./Search.vue";

library.add(faBars, faCode, faUser, faTimes);

export default {
  name: "Navbar",

  directives: { tooltip: VTooltip },

  components: {
    IO,
    Notifications,
    SettingsControl,
    ProfileControl,
    Search
  },

  computed: {
    ...mapState(["meta", "impersonating"]),
    ...mapState("layout", ["isMobile", "isTouch", "menu"]),
    getTitle() {
      return this.meta.appName;
      // return this.meta.user.school.name;
    }
  },

  methods: {
    ...mapMutations("layout/menu", { toggleMenu: "toggle" })
  }
};
</script>

<style lang="scss" scoped>
.navbar {
  z-index: 3;

  -webkit-box-shadow: 0 1px 1px hsla(0, 0%, 4%, 0.35);
  box-shadow: 0 1px 1px hsla(0, 0%, 4%, 0.35);

  .fa-bars {
    transition: transform 0.3s;

    &.rotate {
      transform: rotate(90deg);
    }
  }

  .is-pulled-right {
    margin-left: auto;
  }
}
</style>
