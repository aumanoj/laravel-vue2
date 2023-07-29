<template>
  <!-- Log In page -->
    <!-- Page Content-->
  <div class="page-content-inner">
  <div class="account-body accountbg dark-sidenav-iconbar py-4 mb-2">
    <div class="col-12 align-self-center">
      <div class="auth-page">
        <div class="card auth-card shadow-lg mt-5">
          <div class="card-body">
            <div class="px-3">
              <div class="auth-logo-box">
                <a href="#" class="logo logo-admin"
                  ><img
                    src="/images/logo-sm.png"
                    height="55"
                    alt="logo"
                    class="auth-logo"
                /></a>
              </div>
              <!--end auth-logo-box-->

              <div class="text-center auth-logo-text">
                <h4 class="mt-0 mb-3 mt-5">Reset Password For Admin</h4>
                <p class="text-muted mb-0">
                  Enter your Email and instructions will be sent to you!
                </p>
              </div>
              <!--end auth-logo-text-->
              <!-- <span class="text-danger" v-if="message" >
                          {{ message }}
              </span> -->
              <form class="auth-form my-4" @submit.prevent="fpass">
                <div class="form-group">
                  <label for="useremail">Email <b class="required"> *</b></label>
                  <div class="input-group mb-3">
                    <span class="auth-form-icon">
                      <i class="dripicons-mail"></i>
                    </span>
                    <input
                      type="email"
                      class="form-control"
                      id="useremail"
                      v-model="form.email"
                      placeholder=" Please enter registered email"
                      :class="{
                        'is-invalid': submitted && $v.form.email.$error,
                      }"
                    />
                    <div
                      v-if="submitted && !$v.form.email.required"
                      class="invalid-feedback"
                    >
                      Email is required
                    </div>
                    <div
                      v-if="submitted && !$v.form.email.email"
                      class="invalid-feedback"
                    >
                      Email is invalid
                    </div>
                  </div>
                </div>
                <!--end form-group-->
                <div class="form-group">
                <div class="form-check">
                  <label class="required" for="invalidCheck">
                    (*) Mandatory fields
                  </label>
                </div>
              </div>
                <div class="form-group mb-0 row">
                  <div class="col-12 mt-2">
                    <button
                      class="btn btn-primary btn-round btn-block waves-effect waves-light"
                    >
                      Reset <i class="fas fa-sign-in-alt ml-1"></i>
                    </button>
                  </div>
                  <!--end col-->
                </div>
                <!--end form-group-->
              </form>
              <!--end form-->
            </div>
            <!--end /div-->

            <div class="m-3 text-center text-muted">
              <p class="">
                Remember It ?
                <router-link to="/login" class="text-primary ml-2">
                  Sign in here</router-link
                >
              </p>
            </div>
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
import { required, email } from "vuelidate/lib/validators";
import Url from "../url";
import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
export default {
  data() {
    return {
      form: {
        email: "",
      },
      submitted: false,
      message:''
    };
  },
  validations: {
    form: {
      email: { required, email },
    },
  },
  methods: {
    fpass() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      Url.post("/reset-password",  this.form).then(
        (result) => {
          Vue.$toast.open({
            message: "Password reset email sent!",
            type: "success",
            position: 'top',
            duration: 4000,
          });
          this.response = result.data;
          console.log(result.data);
        })
        .catch((error) => {
          if (error.response.status === 422) {
            Vue.$toast.open({
            message: "Email could not be sent to this email address.",
            type: "error",
            position: 'top',
            duration: 5000,
          });
            this.message = error.response.data.message;
          }
          if (error.response.status === 403) {
            Vue.$toast.open({
            message: "Your email address is not verified.",
            type: "error",
            position: 'top',
            duration: 5000,
          });
            this.message = error.response.data.message;
          }
        });
    },
  },
};
</script>