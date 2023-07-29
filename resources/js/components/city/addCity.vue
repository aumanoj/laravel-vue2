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
                <a href="javascript:void(0);">Add-City</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Add City</h4>
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
        <form @submit.prevent="addCity">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="name">City <b class="required"> *</b></label>
                <input
                  type="text"
                  v-model="form.city"
                  class="form-control"
                  placeholder="Enter city name"
                  id="city"
                  :class="{ 'is-invalid': submitted && $v.form.city.$error }"
                />
                <!-- <span class="text-danger" v-if="errors.city">
                {{ errors.city[0] }}
              </span> -->
              <span class="text-danger" v-if="errors">
                  {{ 'The city has already been taken.' }}
                </span>
                <div
                  v-if="submitted && !$v.form.city.required"
                  class="invalid-feedback">
                  City name is required
                </div>
              </div>
              <div class="form-group">
                <label for="email">State <b class="required"> *</b></label>
                <input
                  type="text"
                  v-model="form.state"
                  class="form-control"
                  placeholder="Enter state name"
                  id="state"
                  :class="{ 'is-invalid': submitted && $v.form.state.$error }"
                />
                <!-- <span class="text-danger" v-if="errors.state">
                {{ errors.state[0] }}
              </span> -->
                <div
                  v-if="submitted && !$v.form.state.required"
                  class="invalid-feedback">
                    State is required
                </div>
              </div>

              <div class="form-group">
                <label for="email">Country <b class="required"> *</b></label>
                <input
                  type="text"
                  v-model="form.country"
                  class="form-control"
                  placeholder="Enter country name"
                  id="country"
                  :class="{ 'is-invalid': submitted && $v.form.country.$error }"
                />
                <!-- <span class="text-danger" v-if="errors.country">
                {{ errors.country[0] }}
              </span> -->
                <div
                  v-if="submitted && !$v.form.country.required"
                  class="invalid-feedback">
                  Country is required
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
                <button type="submit" class="btn btn-primary px-5 py-2">
                  Add
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-11" v-else>
        <div class="card col-md-12  ml-5">
          <div class="card-body ">
            <h4 class="ml-2">Can not access this page! User does not have the right permissions.</h4>
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

import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import { required } from "vuelidate/lib/validators";
import Url from "../../url";
export default {
  data() {
    return {
      form: {
        city: "",
        state: "",
        country:""
      },
      errors: '',
      submitted: false,
      pageShow:true,
      name:[]
    };
  },

  validations: {
    form: {
      city: { required },
      state: { required },
      country:{required}
    },
  },
   mounted() {
    this.getCountry();
  },
  methods: {
     //scrolling page for errors detecting
     scrollToTop() {
        window.scrollTo(0,0);
      },
     getCountry() {
      Url.get("/getCountry").then((response) => {
        this.names = response.data;
      })
      .catch((error) => {
         if (error.response.status === 403) {
          //   Vue.$toast.open({
          //   message: "User does not have the right permissions.",
          //   type: "error",
          //   position: 'top',
          //   duration: 5000,
          // })
          this.pageShow=false;
          console.log("Delete : " + error);
         }

         if (error.response.status === 422) {
            Vue.$toast.open({
            message: "Internal server error",
            type: "error",
            position: 'top',
            duration: 5000,
          })
         }
        });
    },
    addCity() {
      // stop here if form is invalid
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return this.scrollToTop();
      }
      Url.post("/storeCity",this.form)
        .then(() => {
          Vue.$toast.open({
            message: "Record Added Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          this.$router.push({ name: "cityList" });
        })

        .catch((error) => {
         if (error.response.status === 403) {
            Vue.$toast.open({
            message: "User does not have the right permissions.",
            type: "error",
            position: 'top',
            duration: 5000,
          })
          
         }

         if (error.response.status === 422) {
            Vue.$toast.open({
            message: "Internal server error",
            type: "error",
            position: 'top',
            duration: 5000,
          })
         }
        });


        // .catch((error) => {
        //   if (error.response.status === 422) {
        //     this.errors = error.response.data.errors;
        //   }
        // });
    },
  },
};
</script>