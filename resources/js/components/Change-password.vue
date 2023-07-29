<template>
  <div class="page-wrapper">
    <MainMenuComponent />
    <!--main menu & sub-menu component-->
    <div class="page-content">
      <TopbarComponent  />
  <div class="page-content-inner">
    <div class="container-fluid">
      <br />
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
                  <a href="javascript:void(0);">Change Password</a>
                </li>
                <!-- <li class="breadcrumb-item active">Starter</li> -->
              </ol>
            </div>
            <h4 class="page-title">Change Password</h4>
          </div>
          <!--end page-title-box-->
        </div>
        <!--end col-->
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="card">
            <div class="card-body">
              <form
                class="form-horizontal form-material mb-0 needs-validation"
                @submit.prevent="changePassword"
              >
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row mb-2">
                      <label for="password" class="col-lg-3 col-form-label"
                        >Old Password <b class="required"> *</b>
                      </label>
                      <div class="col-lg-8">
                        <input
                          type="password"
                          v-model="password.current_password"
                          formControlName="oldPassword"
                          class="form-control"
                          placeholder=" Enter old password"
                          autocomplete="on"
                          :class="{
                            'is-invalid':
                              submitted && $v.password.current_password.$error,
                          }"
                        />
                        <div
                          v-if="
                            submitted && !$v.password.current_password.required
                          "
                          class="invalid-feedback"
                        >
                          Current password is required
                        </div>
                        <span class="text-danger" v-if="errors">
                          {{ "Current password does not match" }}
                        </span>
                      </div>
                    </div>
                    <!--end form-group-->
                  </div>
                  <!--end col-->
                </div>
                <!--end row-->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="password" class="col-lg-3 col-form-label"
                        >New Password <b class="required"> *</b>
                      </label>
                      <div class="col-lg-8">
                        <input
                          type="password"
                          v-model="password.new_password"
                          formControlName="newPassword"
                          class="form-control"
                          placeholder=" Enter new password"
                          autocomplete="on"
                          :class="{
                            'is-invalid':
                              submitted && $v.password.new_password.$error,
                          }"
                        />
                        <div
                          v-if="
                            submitted && !$v.password.new_password.minLength
                          "
                          class="invalid-feedback"
                        >
                          Password must be at least 8 characters
                        </div>
                        <div
                          v-if="submitted && !$v.password.new_password.required"
                          class="invalid-feedback"
                        >
                          New password is required
                        </div>
                        <!-- <span class="text-danger" v-if="errors.new_password">
                          {{
                            "The password must be at least one character and number."
                          }}
                        </span> -->
                      </div>
                    </div>
                    <!--end form-group-->
                  </div>
                  <!--end col-->
                </div>
                <!--end row-->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="password" class="col-lg-3 col-form-label"
                        >Confirm Password <b class="required"> *</b>
                      </label>
                      <div class="col-lg-8">
                        <input
                          type="password"
                          v-model="password.new_confirm_password"
                          formControlName="confirmPassword"
                          class="form-control"
                          placeholder=" Enter confirm password"
                          autocomplete="on"
                          :class="{
                            'is-invalid':
                              submitted &&
                              $v.password.new_confirm_password.$error,
                          }"
                        />
                        <div
                          v-if="
                            submitted &&
                            !$v.password.new_confirm_password.sameAsPassword
                          "
                          class="invalid-feedback"
                        >
                          Passwords must match
                        </div>
                        <div
                          v-if="
                            submitted &&
                            !$v.password.new_confirm_password.required
                          "
                          class="invalid-feedback"
                        >
                          Confirm password is required
                        </div>
                      </div>
                    </div>
                    <!--end form-group-->
                  </div>
                  <!--end col-->
                </div>
                <!--end row-->
                <div class="form-group">
                  <div class="form-check">
                    <label class="required" for="invalidCheck">
                      (*) Mandatory fields
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7">
                    <button type="submit" class="btn btn-primary float-right">
                      Save change
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!--end col-->
      </div>
      <!--end row-->
    </div>
    <!-- container -->
  </div>
  <!-- content -->
 <FooterComponent />
    </div>
</div>
</template>
<script>
import Vue from "vue"
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import { required, minLength, sameAs } from "vuelidate/lib/validators";
import Axios from 'axios';
import MainMenuComponent from "./layout/MainMenuComponent.vue";
import TopbarComponent from "./layout/TopbarComponent.vue";
import FooterComponent from "./layout/FooterComponent.vue";
export default {
  data() { 
    return {
      password: {
        current_password: "",
        new_password: "",
        new_confirm_password: "",
      },
      errors: "",
      userID: [],
      submitted: false,
    };
  },
  validations: {
    password: {
      current_password: { required },
      new_password: { required,minLength: minLength(8) },
      new_confirm_password: { required,sameAsPassword: sameAs("new_password") },
    },
  },
  mounted() {
    this.userID = localStorage.getItem("userID");
  },
  components:{
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
  },

  
  methods: {
    changePassword() {
      // stop here if form is invalid
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      Axios.post("/change-password", this.password)
        .then((response) => {
          Vue.$toast.open({
            message: "Password Updated Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          console.log(response.data.message);
          this.$router.push({ name: "adminList" });
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>