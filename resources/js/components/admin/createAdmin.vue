<template>
<div class="page-wrapper">
    <MainMenuComponent />
    <!--main menu & sub-menu component-->
    <div class="page-content">
      <TopbarComponent  />
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
                <a href="javascript:void(0);">Add-User</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Add User</h4>
        </div>
        <!--end page-title-box-->
      </div>
      <!--end col-->
      <div class="col-md-12" v-if="pageShow">
        <!-- <router-link :to="{name:'adminList'}"
          ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
            Back
          </button></router-link
        > -->
        <form >
          <div class="card">
            <div class="card-body">
              <div class="row mt-4">
                <div class="col-md-2 ml-5">Name<b class="required"> *</b></div>
                <div class="col-md-7">
                <input
                  type="text"
                  v-model="form.name" 
                  class="form-control"
                  placeholder="Enter name"
                  id="name"
                  :class="{ 'is-invalid': submitted && $v.form.name.$error }"
                />
                <span class="text-danger" v-if="errors.name">
                {{ errors.name[0] }}
              </span>
                <div
                  v-if="submitted && !$v.form.name.required"
                  class="invalid-feedback"
                >
                  Name is required
                </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Email<b class="required"> *</b></div>
                <div class="col-md-7">
                <input
                  type="text"
                  v-model="form.email"
                  class="form-control"
                  placeholder="abc@example.com"
                  id="email"
                  :class="{ 'is-invalid': submitted && $v.form.email.$error }"
                />
                <span class="text-danger" v-if="errors.email">
                {{ errors.email[0] }}
              </span>
                <!-- <span class="text-danger" v-if="errors">
                  {{ "The email has already been taken." }}
                </span> -->
                <div
                  v-if="submitted && !$v.form.email.required"
                  class="invalid-feedback"
                >
                  Email is required
                </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Phone<b class="required"> *</b></div>
                <div class="col-md-7">
                <input
                  type="number"
                  v-model="form.phone"
                  class="form-control"
                  placeholder="Enter phone number"
                  id="phone"
                  :class="{ 'is-invalid': submitted && $v.form.phone.$error }"
                />
                <span class="text-danger" v-if="errors.phone">
                {{ errors.phone[0] }}
              </span>
                <div
                  v-if="submitted && !$v.form.phone.required"
                  class="invalid-feedback"
                >
                  Phone is required
                </div>
                <div
                  v-if="submitted && !$v.form.phone.minLength"
                  class="invalid-feedback"
                >
                  Phone must be at least 10 char long
                </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Password<b class="required"> *</b></div>
                <div class="col-md-7">
                <input
                  type="password"
                  v-model="form.password"
                  class="form-control"
                  placeholder="Enter password"
                  id="password"
                  :class="{
                    'is-invalid': submitted && $v.form.password.$error,
                  }"
                />
                <span class="text-danger" v-if="errors.password">
                {{ "The password must be at least one character and number."}}
              </span>
                <div
                  v-if="submitted && !$v.form.password.required"
                  class="invalid-feedback"
                >
                  Password is required
                </div>
                <div
                  v-if="submitted && !$v.form.password.minLength"
                  class="invalid-feedback"
                >
                  Password must be at least 8 characters
                </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Confirm Password<b class="required"> *</b></div>
                <div class="col-md-7">
                <input
                  type="password"
                  v-model="form.password_confirmation"
                  class="form-control"
                  placeholder="Please re-enter password"
                  id="password_confirmation"
                  :class="{
                    'is-invalid':
                      submitted && $v.form.password_confirmation.$error,
                  }"
                />

                <div
                  v-if="submitted && !$v.form.password_confirmation.required"
                  class="invalid-feedback"
                >
                  Confirm Password is required
                </div>
                <div
                  v-if="
                    submitted && !$v.form.password_confirmation.sameAsPassword
                  "
                  class="invalid-feedback"
                >
                  Passwords must match
                </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Role<b class="required"> *</b></div>
                <div class="col-md-7">
                  <select
                    class="form-control"
                    v-model="form.roles"
                    :class="{ 'is-invalid': submitted && $v.form.roles.$error }"
                  >
                    <option value="" selected disabled>
                      Please Select Role
                    </option>
                    <option
                      v-for="role in p_roles"
                      :key="role.id"
                      :value="role"
                    >
                      {{ role }}
                    </option>
                  </select>
                  <div
                    v-if="submitted && !$v.form.roles.required"
                    class="invalid-feedback"
                  >
                    Roles is required
                  </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="form-check">
                  <label class="required" for="invalidCheck">
                    (*) Mandatory fields
                  </label>
                </div>
              </div>
              
              <div class="row mt-3">
              <div class="col-md-2 ml-5"></div>
              <div class="col-md-6">
                <button
                  type="button" @click.prevent="createUser"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Save
                </button>
                <router-link :to="{name:'adminList'}"
                  ><button
                    type="button"
                    class="btn btn-primary waves-effect waves-light ml-2"
                  >
                    Cancel
                  </button></router-link
                >
              </div>
            </div>
            </div>
            </div>
        </form>
      </div>

      <div class="col-md-11" v-else>
        <div class="card col-md-12  ml-5">
          <div class="card-body ">
            <h4 class="ml-2">{{errors}}</h4>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title end breadcrumb -->
  </div>
  <!-- container -->
  </div>
<FooterComponent />
    </div>
</div>
</template>

<script>

import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import Url from "../../url";
import MainMenuComponent from "../layout/MainMenuComponent.vue";
import TopbarComponent from "../layout/TopbarComponent.vue";
import FooterComponent from "../layout/FooterComponent.vue";
export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
        password: "",
        password_confirmation: "",
        roles: "",
      },
      errors: "",
      submitted: false,
      pageShow:true,
      p_roles: "",
      role: "",
    };
  },

  components: {
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
  },

  validations: {
    form: {
      name: { required },
      email: { required, email },
      phone: { required, minLength: minLength(10) },
      password: { required, minLength: minLength(8) },
      password_confirmation: { required, sameAsPassword: sameAs("password") },
      roles: { required },
    },
  },

  mounted() {
    this.getRole();
  },
  methods: {

    //scrolling page for errors detecting
     scrollToTop() {
        window.scrollTo(0,0);
      },

    getRole() {
      Url.get("/getRole").then((response) => {
        this.p_roles = response.data;
      })
      .catch((error) => {
         if (error.response.status === 403) {
          this.errors = error.response.data.message;
          this.pageShow=false;
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
    createUser() {
      // stop here if form is invalid
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return this.scrollToTop();
      }
      Url.post("/createUser",this.form)
        .then(() => {
          Vue.$toast.open({
            message: "Record Added Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          this.$router.push({ name: "adminList" });
        })

        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            this.scrollToTop();
          }
        });
    },
  },
};
</script>