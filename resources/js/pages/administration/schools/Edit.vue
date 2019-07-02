<template>
  <div class="columns is-centered">
    <div class="column is-three-quarters is-full-touch">
      <enso-form
        class="box has-background-light raises-on-hover animated fadeIn"
        @loaded="schoolId = $refs.form.routeParam('school')"
        ref="form"
      >
        <template slot="logo" slot-scope="{ field, errors, i18n }">
          <div class="columns is-mobile">
            <div class="column">
              <figure class="image is-128x128 avatar">
                <img v-show="showLogo" :src="avatarLink" @error="hideLogo()">
              </figure>
            </div>
            <div class="column">
              <file-uploader
                :url="uploadLink"
                :file-size-limit="500000"
                file-key="logo"
                @upload-successful="updateLogo()"
              >
                <div slot="upload-button" slot-scope="{ openFileBrowser }">
                  <div class="file" @click="openFileBrowser">
                    <label class="file-label">
                      <span class="file-cta">
                        <span class="file-icon">
                          <fa icon="upload"/>
                        </span>
                        <span class="file-label">{{ __('Upload logo') }}…</span>
                      </span>
                    </label>
                  </div>
                </div>
              </file-uploader>
            </div>
          </div>
        </template>
      </enso-form>

      <accessories v-if="schoolId">
        <template slot-scope="{ count }">
          <!-- <tab keep-alive
                        id="People">
                        <people controls
                            :id="schoolId"
                            @update="$set(count, 'people', $refs.people.count)"
                            ref="people"/>
          </tab>-->
          <tab keep-alive id="Addresses">
            <addresses
              controls
              type="LaravelEnso\Schools\app\Models\School"
              :id="schoolId"
              @update="$set(count, 'addresses', $refs.addresses.count)"
              ref="addresses"
            />
          </tab>
          <tab keep-alive id="Comments">
            <comments
              controls
              type="LaravelEnso\Schools\app\Models\School"
              :id="schoolId"
              @update="$set(count, 'comments', $refs.comments.count)"
              ref="comments"
            />
          </tab>
          <tab keep-alive id="Discussions">
            <discussions
              controls
              type="LaravelEnso\Schools\app\Models\School"
              :id="schoolId"
              @update="$set(count, 'discussions', $refs.discussions.count)"
              ref="discussions"
            />
          </tab>
          <tab keep-alive id="Documents">
            <documents
              controls
              type="LaravelEnso\Schools\app\Models\School"
              :id="schoolId"
              @update="$set(count, 'documents', $refs.documents.count)"
              ref="documents"
            />
          </tab>
        </template>
      </accessories>
    </div>
  </div>
</template>

<script>
import Accessories from "../../../components/enso/bulma/Accessories.vue";
import Tab from "../../../components/enso/bulma/Tab.vue";
import Addresses from "../../../components/enso/addresses/Addresses.vue";
import Comments from "../../../components/enso/comments/Comments.vue";
import Discussions from "../../../components/enso/discussions/Discussions.vue";
import Documents from "../../../components/enso/documents/Documents.vue";
// import People from '../../../components/enso/schools/People.vue';
import EnsoForm from "../../../components/enso/vueforms/EnsoForm.vue";
import SelectField from "../../../components/enso/vueforms/fields/SelectField.vue";

import FileUploader from "../../../components/enso/filemanager/FileUploader.vue";

export default {
  components: {
    EnsoForm,
    SelectField,
    Accessories,
    Tab,
    Addresses,
    Comments,
    Discussions,
    Documents,
    FileUploader
    // People,
  },

  data: () => ({
    schoolId: null,
    timeStamp: Date.now(),
    showLogo: true,
  }),

  computed: {
    avatarLink() {
      this.showLogo = true;
      return route("administration.schools.getLogo", { school: this.schoolId, timestamp: this.timeStamp });
    },
    uploadLink() {
      return route("administration.schools.logoUpload", {
        school: this.schoolId
      });
    }
  },
  methods: {
    hideLogo() {
      console.log('HIDE LOGO!!!');
      this.showLogo = false;
    },
    updateLogo() {
      this.timeStamp = Date.now();
      // this.schoolId = ;
    }
  },
};
</script>
