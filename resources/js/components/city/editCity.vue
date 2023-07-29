<template>
  <!-- Page Content-->
  <div class="page-content-inner">
  <div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <div class="float-right">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Admin</a>
              </li>
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Edit-City</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Edit City</h4>
        </div>
        <!--end page-title-box-->
      </div>
      <!--end col-->
      <div class="col-md-12" v-if="pageShow">
        <router-link :to="{name:'cityList'}"
          ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
            Back
          </button></router-link
        >
        <form @submit.prevent="updateCity">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="name">City <b class="required"> *</b></label>
                <input
                  type="hidden"
                  disabled
                  class="form-control"
                  id="id"
                  name="id"
                  required
                  v-model="city.id"
                />
                <input
                  type="text"
                  class="form-control"
                  id="city"
                  name="city"
                  v-model="city.city"
                  :class="{ 'is-invalid': submitted && $v.city.city.$error }"
                />

                <div
                  v-if="submitted && !$v.city.city.required"
                  class="invalid-feedback"
                >
                  City name is required
                </div>
              </div>
              <div class="form-group">
                <label for="email">State <b class="required"> *</b></label>
                <input
                  type="text"
                  class="form-control"
                  id="state"
                  name="state"
                  v-model="city.state"
                  :class="{ 'is-invalid': submitted && $v.city.state.$error }"
                />
                <div
                  v-if="submitted && !$v.city.state.required"
                  class="invalid-feedback"
                >
                  City state is required
                </div>
              </div>

              <div class="form-group">
                <label for="email">Country <b class="required"> *</b></label>
                <input
                  type="text"
                  class="form-control"
                  id="country"
                  name="country"
                  v-model="city.country"
                  :class="{ 'is-invalid': submitted && $v.city.country.$error }"
                />
                <div
                  v-if="submitted && !$v.city.country.required"
                  class="invalid-feedback"
                >
                  City country is required
                </div>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <label class="required" for="invalidCheck">
                    (*) Mandatory fields
                  </label>
                </div>
              </div>
              <div class="row col-md-7 float-right">
                <button class="btn btn-primary px-5 py-2">Update</button>
              </div>
            </div>
          </div>
          <loading
            :active.sync="isLoading"
            :can-cancel="true"
            loader="bars"
            color="#007BFF"
            :is-full-page="false"
          ></loading>
        </form>
      </div>
      <div class="col-md-11" v-else>
        <div class="card col-md-12 ml-5">
          <div class="card-body">
            <h4 class="ml-2">
              Can not access this page! User does not have the right
              permissions.
            </h4>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title end breadcrumb -->
  </div>
  <!-- container -->
  </div>
</template>

<script>

import Url from "../../url";
import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import { required } from "vuelidate/lib/validators";
import Loading from "vue-loading-overlay";
export default {
  data() {
    return {
      city: {},
      errors: "",
      submitted: false,
      isLoading: false,
      fullPage: true,
      pageShow: true,
    };
  },

  validations: {
    city: {
      city: { required },
      state: { required },
      country: { required },
    },
  },
  mounted() {
    this.getCity();
  },
  components: {
    Loading,
  },
  methods: {
     //scrolling page for errors detecting
     scrollToTop() {
        window.scrollTo(0,0);
      },
    getCity() {
      // for loader
      this.isLoading = true;
      // setTimeout(() => {
      //   this.isLoading = false;
      // }, 1000);
      Url.get("/editCity/" + this.$route.params.id)
        .then((response) => {
          this.city = response.data;
          this.isLoading = false;
          console.log(this.city);
        })
        .catch((error) => {
          if (error.response.status === 403) {
            //   Vue.$toast.open({
            //   message: "User does not have the right permissions.",
            //   type: "error",
            //   position: 'top',
            //   duration: 5000,
            // })
            this.pageShow = false;
          }

          if (error.response.status === 422) {
            Vue.$toast.open({
              message: "Internal server error",
              type: "error",
              position: "top",
              duration: 5000,
            });
          }
        });
    },

    updateCity() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return this.scrollToTop();
      }
      Url.post("/updateCity/" + this.$route.params.id, this.city)
        .then((response) => {
          Vue.$toast.open({
            message: "Record Updated Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          console.log(response.data);
          this.$router.push({ name: "cityList" });
        });
    },
  },
};
</script>