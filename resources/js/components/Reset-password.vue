<template>
  <!-- Page Content-->
  <div class="page-content-inner">
  <div class="account-body accountbg dark-sidenav-iconbar py-4 mb-2">
    <div class="col-12 align-self-center">
      <div class="auth-page">
        <div class="card auth-card shadow-lg mt-5">
          <div class="card-body">
            <div class="px-3">
              <!-- <div class="auth-logo-box">
                <a
                  href="#"
                  class="logo logo-admin"
                  ><img
                    src="images/logo-sm.png"
                    height="55"
                    alt="logo"
                    class="auth-logo"
                /></a>
              </div> -->
              <!--end auth-logo-box-->

              <div class="text-center auth-logo-text">
                <h4 class="mt-0 mb-3 mt-5">Please Reset Your Password</h4>
                <p class="text-muted mb-0">Let's Get Started Admin</p>
              </div>
              <!--end auth-logo-text-->
              <!-- <span class="text-danger" v-if="message" >
                          {{ message }}
              </span> -->
              <form class="form-horizontal form-material mb-0 needs-validation" autocomplete="off" @submit.prevent="resetPassword">
              <div class="form-group">
                <label for="email">Email <b class="required"> *</b></label>
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="Please enter registered email"
                  v-model="form.email"
                  :class="{ 'is-invalid': submitted && $v.form.email.$error }"
                />
                <div
                  v-if="submitted && !$v.form.email.required"
                  class="invalid-feedback">
                  Email is required
                </div>
                  <span class="text-danger" v-if="message" >
                          {{ message }}
                  </span>
              </div>
              <div class="form-group">
                <label for="email">Password <b class="required"> *</b></label>
                <input
                  type="password"
                  id="password"
                  class="form-control"
                  placeholder=""
                  v-model="form.password"
                  :class="{ 'is-invalid': submitted && $v.form.password.$error }"
                />
                <div
                  v-if="submitted && !$v.form.password.required"
                  class="invalid-feedback">
                  Password is required
                </div>
                <div v-if="submitted && !$v.form.password.minLength" class="invalid-feedback">Password must be at least 8 characters</div>
              </div>
              <div class="form-group">
                <label for="email">Confirm Password <b class="required"> *</b></label>
                <input
                  type="password"
                  id="password_confirmation"
                  class="form-control"
                  placeholder=""
                  v-model="form.password_confirmation"
                  :class="{ 'is-invalid': submitted && $v.form.password_confirmation.$error }"
                />
                <div
                  v-if="submitted && !$v.form.password_confirmation.required"
                  class="invalid-feedback">
                  Confirm Password is required
                </div>
                <div v-if="submitted && !$v.form.password_confirmation.sameAsPassword" class="invalid-feedback">Passwords must match</div>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <label class="required" for="invalidCheck">
                    (*) Mandatory fields
                  </label>
                </div>
              </div>
              <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">
                Update<i class="fas fa-sign-in-alt ml-1"></i>
              </button>
            </form>
              <!--end form-->
            </div>
            <!--end /div-->

            <!-- <div class="m-3 text-center text-muted">
              <p class="">Don't have an account ?  <a href="#" class="text-primary ml-2">Free Resister</a></p>
            </div> -->
          </div>
          <!--end card-body-->
        </div>
        <!--end card-->
      </div>
      <!--end auth-page-->
    </div>
    <!--end col-->
  </div>
  <!--end row-->
  <!-- End Log In page -->
  </div>
</template>

<script>

import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import { required,minLength, sameAs } from "vuelidate/lib/validators";
import Url from '../url';
//import Url from "../url";
export default {
  data() {
    return {
      form:{
        email:'',
        password: '',
        password_confirmation: '',
        token: this.$route.params.token,
      },
      
      has_error: false,
      message:'',
      submitted:false
    };
  },
   validations: {
    form: {
      email:{required},
      password: { required,minLength: minLength(8) },
      password_confirmation: { required,sameAsPassword: sameAs("password") }
    },
  },
  methods: {
    resetPassword() {
      // stop here if form is invalid
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      Url.post("reset/password",this.form).then((response) => {
          Vue.$toast.open({
            message: "Password reset successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          console.log(response.data);
          this.$router.push({ name: "Login" });
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.message = error.response.data.message;
          }
        });
    },
  },
};
</script>